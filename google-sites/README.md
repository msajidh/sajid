# Google Sites deployment kit

Everything needed to rebuild <https://sites.google.com/view/mdsajidhossain/>
from this repository. Google Sites has no file upload or build step, so the kit
has three parts:

| Folder | What it holds | How it gets into Google Sites |
| --- | --- | --- |
| `pages/` | Copy-ready text for each page | Copy and paste into text boxes |
| `embeds/` | Self-contained HTML blocks (cards, buttons, lists) | **Insert → Embed → Embed code** |
| `../projects/` | Source code and demos | Link to GitHub, or embed a live demo through GitHub Pages |

## 1. Site map

Create these pages in Google Sites (**Pages → +**), in this order:

| # | Page | Content file | Embeds |
| - | --- | --- | --- |
| 1 | Home | `pages/01-home.md` | `embeds/profile-links.html` |
| 2 | About | `pages/02-about.md` | – |
| 3 | Research | `pages/03-research.md` | `embeds/publications.html` |
| 4 | Teaching | `pages/04-teaching.md` | – |
| 5 | Projects | `pages/05-projects.md` | `embeds/projects-gallery.html` |
| 6 | Contact | `pages/06-contact.md` | `embeds/profile-links.html` |

Settings to use (**⚙ Settings**):

- **Navigation → Mode:** Top.
- **Brand images:** add your photo as the favicon and the logo.
- **Themes:** pick *Simple* or *Diplomat*. The embeds use neutral colours
  that suit either one.

## 2. Pasting page text

1. Open the page and choose **Insert → Text box**.
2. Paste the matching section from `pages/NN-*.md`. Paste the rendered text,
   without the Markdown symbols. In each file, `##` headings map to Google
   Sites **Heading** and `###` to **Subheading**.
3. Replace every `[[TODO: …]]` marker with your own details. Those facts
   could not be confirmed from public sources.

## 3. Adding an embed

1. Choose **Insert → Embed → Embed code**.
2. Open the file in `embeds/`, copy all of it, paste it, and click **Next → Insert**.
3. Drag the embed's bottom handle until the iframe shows everything without a
   scrollbar. The suggested height is in a comment at the top of each file.

Each embed file is a complete HTML page with inline CSS and no JavaScript, and
every link opens in a new tab (`target="_blank"`). That is what Google Sites'
sandboxed iframe requires.

## 4. Live project demos (optional, through GitHub Pages)

Google Sites can't run PHP and can't host HTML files. The static demos in
`projects/` can be served from GitHub Pages and embedded **by URL**:

1. On GitHub: **Settings → Pages → Build from a branch → `main` / `(root)`**.
   The `.nojekyll` file at the repo root makes GitHub Pages serve every file as-is.
2. After about a minute the demos are live at
   `https://msajidh.github.io/sajid/<path>`. For example:
   - `projects/web-programming-labs/lab3.html`
   - `projects/web-programming-labs/bootstrap-studio-designs/registration/registration.html`
   - `projects/spark-inverted-index/Posts-Spark.html` (notebook export)
   - `projects/mapreduce-social-graph/socialgraph-Task-1.html`
3. In Google Sites choose **Insert → Embed → By URL** and paste the link.

URL-encode any spaces as `%20`, as in `lab%205_1.html`.

The **Bookstore Web App** is PHP and MySQL, so it can't run on GitHub Pages or
Google Sites. Link to its source on GitHub instead.

## 5. Publishing

1. **Publish** (top right). Keep the web address `mdsajidhossain`.
2. Under **Publish settings → Search**, turn on *Request public search engines
   to not display my site* only if you want the site hidden from search.
3. Open the published site on a phone to check that the embeds resize properly.
