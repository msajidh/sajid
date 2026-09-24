# Md Sajid Hossain: portfolio source

Source material for the personal website
<https://sites.google.com/view/mdsajidhossain/>. It covers projects, teaching
resources and research data, plus a ready-to-use kit for rebuilding the site
in Google Sites.

## Repository layout

```
.
├── google-sites/                  ← start here to build or update the website
│   ├── README.md                  step-by-step Google Sites deployment guide
│   ├── pages/                     copy-ready text for each page
│   └── embeds/                    HTML blocks for Insert → Embed → Embed code
├── projects/
│   ├── matlab-control-compensators/   PI, PD, PID, lag, lead, lag-lead (MATLAB)
│   ├── spark-inverted-index/          term-level inverted index (PySpark)
│   ├── mapreduce-social-graph/        social-network graph jobs (mrjob)
│   ├── bookstore-web-app/             PHP/MySQL online bookstore (group project)
│   ├── android-jukebox-app/           Android login + jukebox app (Java)
│   └── web-programming-labs/          HTML/CSS/JS labs and Bootstrap Studio designs
├── research/
│   └── datasets/hokkaido-wind-speed-data.xlsx
└── .nojekyll                      makes GitHub Pages serve every file as-is
```

## Deploying

See [`google-sites/README.md`](google-sites/README.md). In short:

1. Create the six pages listed there in Google Sites.
2. Paste the text from `google-sites/pages/`.
3. Paste the blocks from `google-sites/embeds/` with **Insert → Embed → Embed code**.
4. (Optional) Turn on GitHub Pages for this repo so you can embed live demos by URL.
5. Publish.
