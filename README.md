# Md Sajid Hossain: personal website

Static personal website for Md Sajid Hossain (Senior Assistant Professor, EEE,
AIUB), rebuilt from the Google Sites page
<https://sites.google.com/view/mdsajidhossain/> and ready to deploy on
[Netlify](https://www.netlify.com/). There are no dependencies: plain HTML,
CSS and a few lines of JavaScript, assembled by one Bash script.

## Repository layout

```
.
├── netlify.toml          build command, publish folder, headers, redirects
├── scripts/build.sh      copies site/ + selected project files into dist/
├── site/                 the website pages (edit these)
│   ├── index.html            Home
│   ├── about/                Biography, education, memberships
│   ├── research/             Research areas, publication profiles, dataset
│   ├── teaching/             MATLAB compensator-design resources
│   ├── projects/             Project cards and live web-lab demos
│   ├── contact/              Address + Netlify contact form (and thanks/)
│   ├── 404.html
│   └── assets/               style.css, main.js, favicon.svg
├── projects/             project source code (linked from the site)
└── research/datasets/    Hokkaido wind speed data (published as a download)
```

`scripts/build.sh` copies only the browser-friendly parts of `projects/` into
the site (MATLAB code and PDF, the Spark notebook export, MapReduce Task 3, the
web-programming labs). Large notebooks, raw data, PHP and Android sources stay
on GitHub, and the project cards link there.

## Deploy on Netlify

1. In Netlify choose **Add new site → Import an existing project → GitHub**
   and pick `msajidh/sajid`.
2. Netlify reads `netlify.toml`, so leave the settings as they are
   (build command `bash scripts/build.sh`, publish directory `dist`).
3. Click **Deploy**. Then, optionally, under **Domain management** rename the
   site (e.g. `mdsajidhossain.netlify.app`) or add a custom domain.
4. Contact-form messages appear under **Forms** in the Netlify dashboard. To
   get them by email, add a notification under
   **Site configuration → Notifications → Form submission notifications**.

Drag-and-drop deploy also works: run `bash scripts/build.sh` locally and drop
the `dist/` folder onto <https://app.netlify.com/drop>.

## Preview locally

```bash
bash scripts/build.sh
python3 -m http.server 8000 --directory dist   # open http://localhost:8000
```

## Editing content

Each page is a single HTML file under `site/`. Header and footer are repeated
in every page, so change them everywhere if you edit the navigation. To add a
photo, put it in `site/assets/` (e.g. `photo.jpg`) and in `site/index.html`
replace `<div class="avatar" aria-hidden="true">SH</div>` with
`<img class="avatar" src="/assets/photo.jpg" alt="Md Sajid Hossain">`.
