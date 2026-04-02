# Lucrarea de laborator nr. 3 — Tema WordPress „USM Theme"

**Disciplina:** Tehnologii Web  
**Student:** *(completează cu numele tău)*  
**Grupa:** *(completează cu grupa ta)*  
**Data:** Aprilie 2026

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
- **`index.php`** — șablonul principal cu bucla WordPress (`WP_Query`) care afișează ultimele 5 postări.

### Pasul 3 — Componente comune ale șabloanelor
- **`header.php`** — antetul cu `wp_head()`, logo, titlul site-ului, descriere și meniu de navigare primar.
- **`footer.php`** — subsolul cu `wp_footer()`, 4 coloane (info site, pagini, categorii, postări recente).
- **`index.php`** include header și footer prin `get_header()` și `get_footer()`.

### Pasul 4 — Fișierul de funcții
- **`functions.php`** înregistrează:
  - Suport temă: `title-tag`, `post-thumbnails`, `html5`, `custom-logo`, `post-formats`
  - Meniuri: `primary`, `footer` via `register_nav_menus()`
  - Widget-uri (sidebar-uri): `sidebar-1`, `sidebar-single` via `register_sidebar()`
  - Stiluri și scripturi prin **`wp_enqueue_style()`** și `wp_enqueue_script()`

### Pasul 5 — Șabloane suplimentare
| Fișier | Rol |
|---|---|
| `single.php` | Postare individuală cu meta, imagine reprezentativă, navigare prev/next, comentarii |
| `page.php` | Pagini statice cu conținut complet și link de editare pentru admini |
| `sidebar.php` | Bara laterală cu `dynamic_sidebar()` sau fallback cu postări recente, categorii, arhivă, căutare, etichete |
| `comments.php` | Lista comentariilor cu template callback personalizat + formular `comment_form()` |
| `archive.php` | Arhive cu `the_archive_title()`, `the_archive_description()` și paginare |

### Pasul 6 — Stilizarea temei
`style.css` conține reguli pentru toate elementele principale:
- **Header** — gradient albastru, sticky, navigare responsivă
- **Carduri postări** — umbră, efect hover, imagine, meta, rezumat, buton „Citește mai mult"
- **Postare/pagină singulară** — layout curat, blockquote, cod, tabele stilizate
- **Bara laterală** — widget-uri cu titlu albastru, umbră ușoară
- **Comentarii** — avatar, formular cu grid pe 2 coloane
- **Footer** — fundal întunecat, 4 coloane responsive
- **Responsive** — `@media` queries pentru tabletă (≤900px) și mobil (≤600px)

### Pasul 7 — Captura de ecran
- `screenshot.png` generat la dimensiunea **1200×900px**, afișat în Appearance → Themes.

### Pasul 8 — Activarea temei
1. Copierea folderului `usm-theme` în directorul `wp-content/themes/` al instalării WordPress locale.
2. Accesare **Appearance → Themes** în panoul de administrare WordPress.
3. Găsirea și activarea temei **USM Theme**.

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
