"""Download official variable fonts, convert to WOFF2 and validate them.

Requires fonttools[woff]. Run from any directory.
"""

from io import BytesIO
from pathlib import Path
from urllib.parse import quote
from urllib.request import Request, urlopen
import hashlib
import json

from fontTools.ttLib import TTFont

DEST = Path(__file__).resolve().parents[1] / 'wp-content' / 'fonts'
FAMILIES = [
    ('Cormorant', 'google/fonts', 'main', 'ofl/cormorant', 'Cormorant', 'ttf', 300, 700),
    ('Montserrat', 'JulietaUla/Montserrat', 'master', 'fonts/webfonts', 'Montserrat', 'woff2', 100, 900),
    ('Montserrat Alternates', 'JulietaUla/Montserrat', 'master', 'fonts-alternates/webfonts', 'MontserratAlternates', 'woff2', 100, 900),
]


def fetch(url):
    with urlopen(Request(url, headers={'User-Agent': 'LGR-font-download'}), timeout=60) as response:
        return response.read()


def raw(repo, revision, path):
    return f'https://raw.githubusercontent.com/{repo}/{revision}/{quote(path, safe="/")}'


def main():
    DEST.mkdir(parents=True, exist_ok=True)
    revisions = {}
    manifest = []
    css = []
    for family, repo, branch, folder, stem, extension, low, high in FAMILIES:
        if repo not in revisions:
            revisions[repo] = json.loads(fetch(f'https://api.github.com/repos/{repo}/commits/{branch}'))['sha']
        revision = revisions[repo]
        license_path = 'ofl/cormorant/OFL.txt' if family == 'Cormorant' else 'OFL.txt'
        (DEST / f'{stem}-OFL.txt').write_bytes(fetch(raw(repo, revision, license_path)))
        for italic in (False, True):
            style = 'italic' if italic else 'normal'
            source_name = f'{stem}{"-Italic" if italic else ""}[wght].{extension}'
            source_url = raw(repo, revision, f'{folder}/{source_name}')
            original = fetch(source_url)
            font = TTFont(BytesIO(original))
            axes = {axis.axisTag: [axis.minValue, axis.maxValue] for axis in font['fvar'].axes}
            assert axes['wght'] == [low, high], (family, axes)
            cmap = font.getBestCmap()
            assert all(ord(char) in cmap for char in 'éèêëàâäùûüîïôöçœÉÀÇŒ'), family
            target_name = f'{stem}-{style}-variable.woff2'
            target = DEST / target_name
            font.flavor = 'woff2'
            font.save(target)
            font.close()
            with TTFont(target) as checked:
                assert checked.flavor == 'woff2'
                assert 'fvar' in checked
            payload = target.read_bytes()
            assert payload[:4] == b'wOF2'
            manifest.append(dict(family=family, style=style, file=target_name,
                                 axes=axes, source=source_url, revision=revision,
                                 sha256=hashlib.sha256(payload).hexdigest(), bytes=len(payload)))
            css.append(f"@font-face {{\n  font-family: '{family}';\n  font-style: {style};\n  font-weight: {low} {high};\n  font-display: swap;\n  src: url('./{target_name}') format('woff2');\n}}\n")
            print(f'{target_name}: wght {low}-{high}, {len(payload)} bytes, French characters OK')
    (DEST / 'fonts.css').write_text('\n'.join(css), encoding='utf-8')
    (DEST / 'sources.json').write_text(json.dumps(manifest, indent=2) + '\n', encoding='utf-8')


if __name__ == '__main__':
    main()
