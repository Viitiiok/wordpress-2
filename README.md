# Lucrarea de laborator nr. 3 — Tema WordPress „USM Theme"

**Disciplina:** CMS
**Student:** Rusu Victor
**Grupa:** IA2302

---

## Scopul lucrării

Crearea unei teme WordPress personalizate de la zero, înțelegerea structurii minime a unei teme și a principiilor de funcționare ale șabloanelor WordPress.

---

## Structura proiectului

```
wp-content/themes/usm-theme/
├── style.css          # Metadatele temei + toate regulile CSS
├── index.php          # Șablonul principal (lista ultimelor 5 postări)
├── header.php         # Antetul site-ului (doctype, <head>, nav)
├── footer.php         # Subsolul site-ului (4 coloane + copyright)
├── functions.php      # Funcții temă: suport caracteristici, meniuri, widget-uri, stiluri
├── single.php         # Afișarea unei postări individuale
├── page.php           # Afișarea paginilor statice
├── sidebar.php        # Bara laterală (widget-uri sau fallback implicit)
├── comments.php       # Afișarea comentariilor + formular
├── archive.php        # Arhivele postărilor (categorie, etichetă, autor, dată)
├── screenshot.png     # Previzualizarea temei în panoul de administrare (1200×900px)
└── js/
    └── navigation.js  # Toggle meniu mobil (accesibil, cu aria-expanded)

wp-config.php          # Configurare WordPress cu WP_DEBUG activat
```

<img width="266" height="311" alt="Screenshot 2026-04-02 at 13 53 52" src="https://github.com/user-attachments/assets/4cf9abf1-dc08-4073-8db0-bd97014b6994" />

---

## Pașii realizați

### Pasul 1 — Pregătirea mediului
- Creat directorul `wp-content/themes/usm-theme/`.
- Activat modul de depanare în `wp-config.php`:
  ```php
  define( 'WP_DEBUG', true );
  define( 'WP_DEBUG_LOG', true );
  define( 'WP_DEBUG_DISPLAY', true );
  ```
<img width="673" height="579" alt="Screenshot 2026-04-02 at 13 56 57" src="https://github.com/user-attachments/assets/de161073-c1c1-4668-8feb-90999a7ad03b" />

### Pasul 2 — Fișierele obligatorii ale temei
- **`style.css`** — conține metadatele necesare recunoașterii temei de WordPress:
  ```css
  /*
  Theme Name: USM Theme
  Author: Student USM
  Version: 1.0.0
  ...
  */
  ```
<img width="627" height="432" alt="Screenshot 2026-04-02 at 13 58 52" src="https://github.com/user-attachments/assets/421ea62d-da6d-4ae3-923b-c00e12d747a6" />

### Pasul 3 — Componente comune ale șabloanelor
- **`header.php`** — antetul cu `wp_head()`, logo, titlul site-ului, descriere și meniu de navigare primar.
- **`footer.php`** — subsolul cu `wp_footer()`, 4 coloane (info site, pagini, categorii, postări recente).
- **`index.php`** include header și footer prin `get_header()` și `get_footer()`.
<img width="779" height="597" alt="Screenshot 2026-04-02 at 13 59 57" src="https://github.com/user-attachments/assets/3599d1ca-8114-4f13-87fb-c20e3f88c4df" />
<img width="876" height="447" alt="Screenshot 2026-04-02 at 14 00 16" src="https://github.com/user-attachments/assets/68593c01-5d88-435a-808f-54412c820f01" />

### Pasul 4 — Fișierul de funcții
- **`functions.php`** înregistrează:
  - Suport temă: `title-tag`, `post-thumbnails`, `html5`, `custom-logo`, `post-formats`
  - Meniuri: `primary`, `footer` via `register_nav_menus()`
  - Widget-uri (sidebar-uri): `sidebar-1`, `sidebar-single` via `register_sidebar()`
  - Stiluri și scripturi prin **`wp_enqueue_style()`** și `wp_enqueue_script()`
<img width="749" height="729" alt="Screenshot 2026-04-02 at 14 01 03" src="https://github.com/user-attachments/assets/688d512c-ab5d-4bc5-b816-474f622193aa" />

### Pasul 5 — Șabloane suplimentare
| Fișier | Rol |
|---|---|
| `single.php` | Postare individuală cu meta, imagine reprezentativă, navigare prev/next, comentarii |
| `page.php` | Pagini statice cu conținut complet și link de editare pentru admini |
| `sidebar.php` | Bara laterală cu `dynamic_sidebar()` sau fallback cu postări recente, categorii, arhivă, căutare, etichete |
| `comments.php` | Lista comentariilor cu template callback personalizat + formular `comment_form()` |
| `archive.php` | Arhive cu `the_archive_title()`, `the_archive_description()` și paginare |
<img width="965" height="648" alt="Screenshot 2026-04-02 at 14 03 11" src="https://github.com/user-attachments/assets/819b415c-9abb-488d-82c1-577cb1e1e5ca" />

### Pasul 6 — Stilizarea temei
`style.css` conține reguli pentru toate elementele principale:
- **Header** — gradient albastru, sticky, navigare responsivă
- **Carduri postări** — umbră, efect hover, imagine, meta, rezumat, buton „Citește mai mult"
- **Postare/pagină singulară** — layout curat, blockquote, cod, tabele stilizate
- **Bara laterală** — widget-uri cu titlu albastru, umbră ușoară
- **Comentarii** — avatar, formular cu grid pe 2 coloane
- **Footer** — fundal întunecat, 4 coloane responsive
- **Responsive** — `@media` queries pentru tabletă (≤900px) și mobil (≤600px)
<img width="668" height="508" alt="Screenshot 2026-04-02 at 14 03 43" src="https://github.com/user-attachments/assets/fe0be86e-511a-44dd-a826-8bcbd96402ca" />

### Pasul 7 — Captura de ecran
- `screenshot.png` generat la dimensiunea **1200×900px**, afișat în Appearance → Themes.
<img width="1110" height="511" alt="Screenshot 2026-04-02 at 14 04 10" src="https://github.com/user-attachments/assets/35f798d0-3685-47af-a1d5-ffa545e645e6" />
<img width="1398" height="632" alt="Screenshot 2026-04-02 at 14 04 32" src="https://github.com/user-attachments/assets/5544172c-6674-443f-a764-29872ba7af98" />

### Pasul 8 — Activarea temei
1. Copierea folderului `usm-theme` în directorul `wp-content/themes/` al instalării WordPress locale.
2. Accesare **Appearance → Themes** în panoul de administrare WordPress.
3. Găsirea și activarea temei **USM Theme**.
<img width="1779" height="944" alt="Screenshot 2026-04-02 at 14 04 56" src="https://github.com/user-attachments/assets/c08c6482-ed73-4c92-8c26-432100201ede" />

---

## Tehnologii utilizate

- **PHP** — logica șabloanelor WordPress
- **HTML5** — structură semantică (`<header>`, `<main>`, `<footer>`, `<article>`, `<aside>`)
- **CSS3** — Flexbox, Grid, variabile, tranziții, media queries
- **JavaScript (Vanilla)** — toggle meniu mobil cu suport accesibilitate (`aria-expanded`)
- **WordPress Template Hierarchy** — `index.php`, `single.php`, `page.php`, `archive.php`
- **WordPress Template Tags** — `the_loop()`, `get_header()`, `get_footer()`, `get_sidebar()`, `comments_template()`, `wp_nav_menu()`, `dynamic_sidebar()`

---

## Activarea WP_DEBUG

În `wp-config.php` au fost adăugate:
```php
define( 'WP_DEBUG', true );         // Activează afișarea erorilor PHP
define( 'WP_DEBUG_LOG', true );     // Salvează erorile în wp-content/debug.log
define( 'WP_DEBUG_DISPLAY', true ); // Afișează erorile în browser (doar local!)
```

> ⚠️ `WP_DEBUG` trebuie dezactivat (`false`) pe orice site de producție.
