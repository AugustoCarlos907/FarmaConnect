<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Produtos</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:        #0899a6;
      --accent-2:      #05707a;
      --accent-light:  #e6f7f8;
      --accent-mid:    #b2e8ec;
      --danger:        #d94040;
      --danger-light:  #fdecea;
      --warning:       #d97706;
      --warning-light: #fef3c7;
      --success:       #16a34a;
      --success-light: #dcfce7;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-sm:     0 1px 3px rgba(0,0,0,.06);
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --topbar-h:      52px;
      --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 18px;
    }

    html { font-size: 13px; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR (idêntica ao dashboard) ───── */
    .sidebar {
      width: 220px; flex-shrink: 0;
      background: var(--surface); border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; height: 100vh;
      overflow-y: auto; overflow-x: hidden; z-index: 200;
    }
    .sidebar-header {
      height: var(--topbar-h); min-height: var(--topbar-h);
      flex-shrink: 0; display: flex; align-items: center;
      padding: 0 16px; border-bottom: 1px solid var(--border);
    }
    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); }
    .logo-text .c { color: var(--text); }
    .sidebar-body { flex: 1; overflow-y: auto; padding: 8px 0 12px; }
    .sidebar-body::-webkit-scrollbar { width: 0; }
    .nav-section { padding: 0 8px; }
    .nav-label { font-size: 0.67rem; font-weight: 600; color: var(--text-4); text-transform: uppercase; letter-spacing: .07em; padding: 10px 8px 4px; display: block; }
    .nav-item { display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: var(--r-md); font-size: 0.82rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: background .1s, color .1s; border: none; background: none; width: 100%; text-align: left; font-family: 'DM Sans', sans-serif; text-decoration: none; margin-bottom: 1px; }
    .nav-item i { font-size: 0.88rem; width: 15px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
    .nav-item.active i { color: var(--accent); }
    .nav-badge { margin-left: auto; font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; line-height: 1.5; }
    .nb-red   { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal  { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .sub-item.active-sub { color: var(--accent); font-weight: 600; }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .nav-divider { height: 1px; background: var(--border); margin: 6px 12px; }
    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

        /* Logout button */
    .logout-form {
        margin-top: 12px;
    }

    .logout-btn {
        color: var(--danger);
    }

    .logout-btn i {
        color: var(--danger);
    }

    .logout-btn:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    .logout-btn:hover i {
        color: var(--danger);
    }
    /* ─── MAIN ────────────────────────────── */
    .main { flex: 1; margin-left: 220px; display: flex; flex-direction: column; min-height: 100vh; }

    .topbar {
      background: var(--surface); border-bottom: 1px solid var(--border);
      padding: 0 22px; height: var(--topbar-h);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100; flex-shrink: 0;
    }
    .tb-left { display: flex; align-items: center; gap: 8px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); }
    .tb-sub { font-size: 0.78rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }
    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); border-color: var(--border-strong); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }
    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; transition: all .1s; }
    .user-chip:hover { background: var(--surface-2); }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; display: flex; flex-direction: column; }

    /* ─── TOOLBAR ─────────────────────────── */
    .toolbar {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 14px; flex-wrap: wrap;
    }
    .toolbar-left  { display: flex; align-items: center; gap: 8px; flex: 1; min-width: 0; flex-wrap: wrap; }
    .toolbar-right { display: flex; align-items: center; gap: 7px; flex-shrink: 0; }

    /* Search */
    .search-wrap {
      position: relative; flex: 1; min-width: 200px; max-width: 340px;
    }
    .search-wrap i {
      position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
      color: var(--text-4); font-size: 0.85rem; pointer-events: none;
    }
    .search-input {
      width: 100%; padding: 6px 10px 6px 32px;
      border: 1px solid var(--border); border-radius: var(--r-md);
      font-size: 0.8rem; font-family: 'DM Sans', sans-serif;
      background: var(--surface); color: var(--text);
      transition: border-color .1s, box-shadow .1s;
    }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }

    /* Filter chips */
    .filter-chips { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
    .chip {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 10px; border-radius: 20px;
      font-size: 0.75rem; font-weight: 500;
      border: 1px solid var(--border); background: var(--surface);
      color: var(--text-3); cursor: pointer; transition: all .1s;
      white-space: nowrap;
    }
    .chip:hover { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .chip.active { background: var(--accent); border-color: var(--accent); color: #fff; }
    .chip i { font-size: 0.72rem; }
    .chip .chip-x { font-size: 0.72rem; opacity: .7; margin-left: 2px; }
    .chip .chip-x:hover { opacity: 1; }

    /* Select dropdown styled */
    .filter-select {
      padding: 5px 28px 5px 10px;
      border: 1px solid var(--border); border-radius: var(--r-md);
      font-size: 0.78rem; font-family: 'DM Sans', sans-serif;
      background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 9px center;
      color: var(--text-2); cursor: pointer; appearance: none;
      transition: border-color .1s;
    }
    .filter-select:focus { outline: none; border-color: var(--accent); }

    /* Buttons */
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-danger { background: var(--surface); color: var(--danger); border-color: #fca5a5; }
    .btn-danger:hover { background: var(--danger-light); }
    .btn-icon { padding: 5px 8px; }

    /* View toggle */
    .view-toggle { display: flex; border: 1px solid var(--border); border-radius: var(--r-md); overflow: hidden; }
    .view-btn { padding: 5px 9px; font-size: 0.85rem; color: var(--text-3); cursor: pointer; border: none; background: var(--surface); transition: all .1s; }
    .view-btn:hover { background: var(--surface-2); color: var(--text); }
    .view-btn.active { background: var(--accent-light); color: var(--accent); }

    /* ─── STATS BAR ───────────────────────── */
    .stats-bar {
      display: flex; align-items: center; gap: 16px;
      padding: 10px 14px; margin-bottom: 12px;
      background: var(--surface); border: 1px solid var(--border);
      border-radius: var(--r-xl); font-size: 0.77rem;
      flex-wrap: wrap;
    }
    .stat-item { display: flex; align-items: center; gap: 6px; }
    .stat-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
    .stat-label { color: var(--text-3); }
    .stat-val { font-weight: 600; color: var(--text); }
    .stat-divider { width: 1px; height: 16px; background: var(--border); flex-shrink: 0; }
    .stat-total { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.88rem; }

    /* ─── ACTIVE FILTERS ──────────────────── */
    .active-filters {
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 10px; font-size: 0.77rem; flex-wrap: wrap;
    }
    .af-label { color: var(--text-3); font-weight: 500; }
    .af-clear { background: none; border: none; cursor: pointer; font-size: 0.75rem; color: var(--text-3); font-family: 'DM Sans', sans-serif; padding: 0; }
    .af-clear:hover { color: var(--danger); text-decoration: underline; }

    /* ─── TABLE ───────────────────────────── */
    .table-wrap {
      flex: 1; background: var(--surface);
      border: 1px solid var(--border); border-radius: var(--r-xl);
      overflow: hidden; display: flex; flex-direction: column;
    }

    .table-scroll { overflow-x: auto; flex: 1; }

    table {
      width: 100%; border-collapse: collapse; font-size: 0.78rem;
      min-width: 760px;
    }

    thead { position: sticky; top: 0; z-index: 10; }

    thead tr { background: var(--surface-2); }

    th {
      padding: 10px 12px; text-align: left;
      font-size: 0.67rem; font-weight: 600; color: var(--text-3);
      text-transform: uppercase; letter-spacing: .05em;
      border-bottom: 1px solid var(--border);
      white-space: nowrap; user-select: none; cursor: pointer;
    }
    th:hover { color: var(--text); }
    th.sorted { color: var(--accent); }
    th .sort-icon { font-size: 0.6rem; margin-left: 3px; opacity: .5; }
    th.sorted .sort-icon { opacity: 1; color: var(--accent); }
    th.no-sort { cursor: default; }
    th:first-child { padding-left: 16px; }
    th:last-child  { padding-right: 16px; }

    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background .08s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    tbody tr.selected { background: var(--accent-light); }
    tbody tr.selected:hover { background: #d0f2f4; }

    td { padding: 10px 12px; vertical-align: middle; color: var(--text-2); }
    td:first-child { padding-left: 16px; }
    td:last-child  { padding-right: 16px; }

    /* Checkbox col */
    .col-check { width: 36px; }
    .row-check { width: 14px; height: 14px; accent-color: var(--accent); cursor: pointer; }

    /* Produto col */
    .prod-cell { display: flex; align-items: center; gap: 10px; }
    .prod-ico {
      width: 34px; height: 34px; border-radius: var(--r-md);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.9rem; flex-shrink: 0;
    }
    .prod-ico.analgesico    { background: #fdecea; color: #a32d2d; }
    .prod-ico.antibiotico   { background: #faeeda; color: #854f0b; }
    .prod-ico.cardiovascular{ background: var(--danger-light); color: var(--danger); }
    .prod-ico.diabetes      { background: var(--accent-light); color: var(--accent-2); }
    .prod-ico.digestivo     { background: var(--success-light); color: #15803d; }
    .prod-ico.vitamina      { background: #fef3c7; color: #92400e; }
    .prod-ico.respiratorio  { background: #ede9fe; color: #5b21b6; }
    .prod-ico.dermatologia  { background: #fce7f3; color: #9d174d; }
    .prod-ico.outro         { background: var(--surface-2); color: var(--text-3); }

    .prod-name { font-weight: 600; color: var(--text); margin-bottom: 1px; }
    .prod-sku  { font-size: 0.67rem; color: var(--text-4); font-family: 'DM Mono', monospace; }

    /* Stock bar */
    .stock-cell { min-width: 110px; }
    .stock-qty  { font-weight: 600; color: var(--text); }
    .stock-bar-wrap { height: 3px; background: var(--border); border-radius: 10px; margin-top: 4px; }
    .stock-bar { height: 3px; border-radius: 10px; }

    /* Tags */
    .tag { display: inline-flex; align-items: center; font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; white-space: nowrap; }
    .tag::before { content: ''; width: 4px; height: 4px; border-radius: 50%; margin-right: 4px; }
    .tag-ok     { background: var(--success-light); color: #15803d; }
    .tag-ok::before     { background: var(--success); }
    .tag-low    { background: var(--warning-light); color: #854f0b; }
    .tag-low::before    { background: var(--warning); }
    .tag-critical { background: var(--danger-light); color: var(--danger); }
    .tag-critical::before { background: var(--danger); }
    .tag-out    { background: #f1f5f9; color: var(--text-3); }
    .tag-out::before    { background: var(--text-4); }

    /* Category badge */
    .cat-badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 20px; font-size: 0.67rem; font-weight: 600; white-space: nowrap; }

    /* Price */
    .price-val { font-family: 'Sora', sans-serif; font-weight: 600; color: var(--text); }
    .price-unit { font-size: 0.67rem; color: var(--text-4); display: block; }

    /* Actions */
    .row-actions { display: flex; align-items: center; gap: 4px; opacity: 0; transition: opacity .1s; }
    tbody tr:hover .row-actions { opacity: 1; }
    .act-btn { width: 26px; height: 26px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.8rem; color: var(--text-3); transition: all .1s; }
    .act-btn:hover { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .act-btn.danger:hover { border-color: #fca5a5; color: var(--danger); background: var(--danger-light); }

    /* ─── BULK ACTION BAR ─────────────────── */
    .bulk-bar {
      display: none; align-items: center; gap: 10px;
      padding: 10px 14px; margin-bottom: 12px;
      background: var(--accent); border-radius: var(--r-xl);
      color: #fff; font-size: 0.8rem; font-weight: 500;
      animation: slideDown .15s ease;
    }
    .bulk-bar.show { display: flex; }
    @keyframes slideDown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }
    .bulk-bar .bulk-count { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.95rem; }
    .bulk-spacer { flex: 1; }
    .bulk-btn { display: inline-flex; align-items: center; gap: 5px; padding: 4px 11px; border-radius: var(--r-md); font-size: 0.75rem; font-weight: 600; cursor: pointer; border: 1px solid rgba(255,255,255,.3); background: rgba(255,255,255,.12); color: #fff; transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .bulk-btn:hover { background: rgba(255,255,255,.22); }
    .bulk-btn.bulk-danger { border-color: rgba(255,100,100,.5); background: rgba(255,80,80,.18); }
    .bulk-btn.bulk-danger:hover { background: rgba(255,80,80,.3); }
    .bulk-close { background: none; border: none; color: rgba(255,255,255,.7); cursor: pointer; font-size: 1rem; margin-left: 4px; }
    .bulk-close:hover { color: #fff; }

    /* ─── TABLE FOOTER / PAGINATION ──────── */
    .table-footer {
      display: flex; align-items: center; justify-content: space-between;
      padding: 10px 16px; border-top: 1px solid var(--border);
      background: var(--surface-2); font-size: 0.77rem; color: var(--text-3);
      flex-shrink: 0; flex-wrap: wrap; gap: 8px;
    }
    .rows-select { padding: 3px 22px 3px 8px; border: 1px solid var(--border); border-radius: var(--r-sm); font-size: 0.75rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 7px center; appearance: none; color: var(--text-2); cursor: pointer; }
    .pagination { display: flex; align-items: center; gap: 3px; }
    .pg-btn { min-width: 28px; height: 28px; padding: 0 6px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); font-size: 0.77rem; font-family: 'DM Sans', sans-serif; color: var(--text-3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .pg-btn:hover:not(:disabled) { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .pg-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
    .pg-btn:disabled { opacity: .35; cursor: default; }
    .pg-ellipsis { padding: 0 4px; color: var(--text-4); font-size: 0.77rem; }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); }
    .empty-ico { width: 52px; height: 52px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 12px; }
    .empty-state h3 { font-size: 0.9rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p { font-size: 0.78rem; text-align: center; max-width: 260px; }

    /* ─── DRAWER (produto detalhe / edição) ── */
    .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.35); z-index: 400; backdrop-filter: blur(1px); }
    .drawer-overlay.open { display: block; }
    .drawer {
      position: fixed; top: 0; right: -440px; width: 440px; max-width: 95vw;
      height: 100vh; background: var(--surface);
      border-left: 1px solid var(--border);
      display: flex; flex-direction: column;
      transition: right .25s cubic-bezier(.4,0,.2,1);
      z-index: 500;
      box-shadow: -8px 0 32px rgba(0,0,0,.1);
    }
    .drawer.open { right: 0; }
    .drawer-head { padding: 18px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
    .drawer-head h2 { font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 600; }
    .drawer-close { background: none; border: none; cursor: pointer; color: var(--text-3); font-size: 1rem; width: 28px; height: 28px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .drawer-close:hover { background: var(--surface-2); color: var(--text); }
    .drawer-body { flex: 1; overflow-y: auto; padding: 20px; }
    .drawer-footer { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; gap: 8px; justify-content: flex-end; flex-shrink: 0; }

    /* Drawer form */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
    .form-row.single { grid-template-columns: 1fr; }
    .form-group { display: flex; flex-direction: column; gap: 5px; }
    .form-group label { font-size: 0.75rem; font-weight: 600; color: var(--text-2); }
    .form-input, .form-select, .form-textarea {
      padding: 7px 10px; border: 1px solid var(--border); border-radius: var(--r-md);
      font-size: 0.8rem; font-family: 'DM Sans', sans-serif; color: var(--text);
      background: var(--surface); transition: border-color .1s;
    }
    .form-textarea { resize: vertical; min-height: 72px; }
    .form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 9px center; padding-right: 28px; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .form-hint { font-size: 0.68rem; color: var(--text-4); }
    .field-group-title { font-size: 0.72rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .06em; margin: 18px 0 10px; padding-bottom: 6px; border-bottom: 1px solid var(--border); }

    /* Stock indicator in drawer */
    .stock-indicator { display: flex; gap: 8px; margin-top: 4px; }
    .si-item { flex: 1; padding: 8px 10px; border-radius: var(--r-md); border: 1px solid var(--border); text-align: center; cursor: pointer; transition: all .1s; }
    .si-item.selected { border-color: var(--accent); background: var(--accent-light); }
    .si-item span { font-size: 0.67rem; font-weight: 600; color: var(--text-3); display: block; }
    .si-item.selected span { color: var(--accent-2); }

    /* ─── MODAL CONFIRMAR ─────────────────── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.48); z-index: 600; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--r-xl); padding: 22px; width: 380px; max-width: 94vw; box-shadow: 0 20px 50px rgba(0,0,0,.18); animation: mIn .18s ease; }
    @keyframes mIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-ico { width: 40px; height: 40px; border-radius: var(--r-lg); background: var(--danger-light); color: var(--danger); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: 12px; }
    .modal-box h3 { font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 600; margin-bottom: 6px; }
    .modal-box p { font-size: 0.8rem; color: var(--text-3); line-height: 1.5; margin-bottom: 18px; }
    .modal-foot { display: flex; gap: 8px; justify-content: flex-end; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    /* ─── RESPONSIVE ──────────────────────── */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .toolbar-left { flex-direction: column; align-items: stretch; }
      .search-wrap { max-width: 100%; }
    }
  </style>
</head>
<body>
<div class="layout">

  <!-- ══ SIDEBAR ══════════════════════════════════ -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="logo">
            <div class="logo-mark">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13v-2H9v-2h2V9h2v2h2v2h-2v2h-2z"/></svg>
            </div>
            <span class="logo-text"><span class="f">Farma</span><span class="c">Connect</span></span>
        </a>
    </div>

    <div class="sidebar-body">
        <div class="nav-section">
            <span class="nav-label">Principal</span>
            
            <!-- Dashboard -->
            <a href="{{ route('index.farmacias') }}" class="nav-item {{ request()->routeIs('index.farmacias') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Stock com submenu -->
            <div class="has-sub {{ request()->routeIs('medicamentos.farmacias') ? 'open' : '' }}" id="sub-stock">
                <div class="nav-item" onclick="toggleSub('sub-stock')">
                    <i class="bi bi-archive"></i>
                    <span>Stock</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <a href="{{ route('medicamentos.farmacias') }}" class="sub-item {{ request()->routeIs('medicamentos.farmacias') ? 'active-sub' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Lista de produtos</span>
                    </a>
                    {{-- <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div> --}}
                </div>
            </div>

            <!-- Pedidos -->
            <a href="{{ route('pedidos.farmacias') }}" class="nav-item {{ request()->routeIs('pedidos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Pedidos</span>

            </a>

            <!-- Entregadores -->
            <a href="{{ route('entregadores.farmacias') }}" class="nav-item {{ request()->routeIs('entregadores.farmacias') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Entregadores</span>

            </a>

            <!-- Clientes -->
            <a href="{{ route('clientes.farmacias') }}" class="nav-item {{ request()->routeIs('clientes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>

            <!-- Avaliações -->
            <a href="{{ route('avaliacoes.farmacias') }}" class="nav-item {{ request()->routeIs('avaliacoes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-star"></i>
                <span>Avaliações</span>

            </a>

            <span class="nav-label">Gestão</span>

            <!-- Documentos -->
            <a href="{{ route('documentos.farmacias') }}" class="nav-item {{ request()->routeIs('documentos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Documentos</span>
            </a>

            <!-- Configurações com submenu -->
            <div class="has-sub" id="sub-cfg">
                <div class="nav-item" onclick="toggleSub('sub-cfg')">
                    <i class="bi bi-gear"></i>
                    <span>Configurações</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <div class="sub-item">
                        <i class="bi bi-person"></i>
                        <span>Perfil</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-shop"></i>
                        <span>Farmácia</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-clock"></i>
                        <span>Horário</span>
                    </div>
                </div>
            </div>

            <!-- Sair -->
            <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post" class="logout-form">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </div>

    <div class="sidebar-footer">
        @php
            $farmacia = Auth::user()->farmacia;
        @endphp
        <div class="ph-card">
            <div class="ph-row">
                <span class="ph-name">{{ $farmacia->name ?? 'Farmácia' }}</span>
                <span class="ph-pill pill-open">{{ $farmacia->status ?? 'Aberta' }}</span>
            </div>
            <p class="ph-meta"><i class="bi bi-geo-alt"></i> {{ $farmacia->endereco ?? '—' }}</p>
            <p class="ph-meta"><i class="bi bi-clock"></i> {{ $farmacia->horario_abertura ?? '08:00' }} - {{ $farmacia->horario_fechamento ?? '22:00' }}</p>
            <p class="ph-meta" style="opacity:.55;font-size:.65rem;margin-top:2px"><i class="bi bi-building"></i> {{ $farmacia->company ?? 'FarmaConnect' }}</p>
        </div>
    </div>
</aside>

  <!-- ══ MAIN ══════════════════════════════════════ -->
  <div class="main">
    <header class="topbar">
      <div class="tb-left">
        <h1>Stock</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub">Lista de produtos</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
          <div><span class="u-name">{{Auth::user()->farmacia->name ?? 'FC'}}</span><span class="u-role">{{Auth::user()->name ?? 'Farmacêutico'}}</span></div>

        </div>
      </div>
    </header>

    <div class="content">

      @if(session('success'))
    <div class="alert-fc alert-success mt-3 mb-3" style="background: #dcfce7; border-color: #bbf7d0; color: #15803d;">
        <i class="bi bi-check-circle-fill flex-shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

      <!-- ─── TOOLBAR ────────────────────── -->
      <div class="toolbar">
        <div class="toolbar-left">
          <!-- Search -->

          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <form action="{{ route('medicamentos.farmacias') }}" method="GET" id="filterForm" >
              <input type="text" class="search-input" name="search" value="{{ request('search') }}" id="searchInput" placeholder="Pesquisar por medicamento …" oninput="filterTable()">
                <input type="hidden" name="categoria" id="categoriaHidden" value="{{ request('categoria') }}">
                <!-- Os outros inputs (search, stock, sort) serão movidos para dentro do form -->
                <!-- ... -->
            </form>
          </div>
          <!-- Filtros rápidos por categoria -->
          <div class="filter-chips" id="catChips">
              <button type="button" class="chip {{ !request('categoria') ? 'active' : '' }}" data-cat="" onclick="setCategoriaAndSubmit('')">Todos</button>
              @php
                  $categorias = $medicamentos->pluck('categoria.name')->unique()->filter();
              @endphp
              @foreach($categorias as $categoria)
                  <button type="button" class="chip {{ request('categoria') == $categoria ? 'active' : '' }}" data-cat="{{ $categoria }}" onclick="setCategoriaAndSubmit('{{ $categoria }}')">
                      <i class="bi bi-capsule"></i> {{ $categoria }}
                  </button>
              @endforeach
          </div>
        </div>

        <div class="toolbar-right">
          <!-- Filtro de stock -->
          <select class="filter-select" id="stockFilter" onchange="filterTable()">
            <option value="all">Todos os stocks</option>
            <option value="ok">Normal</option>
            <option value="low">Stock baixo</option>
            <option value="critical">Crítico</option>
            <option value="out">Esgotado</option>
          </select>

          <!-- Ordenar -->
          <select class="filter-select" id="sortSelect" onchange="sortTable()">
            <option value="name-asc">Nome A→Z</option>
            <option value="name-desc">Nome Z→A</option>
            <option value="stock-asc">Stock ↑</option>
            <option value="stock-desc">Stock ↓</option>
            <option value="price-asc">Preço ↑</option>
            <option value="price-desc">Preço ↓</option>
          </select>

          <!-- View toggle -->
          {{-- <div class="view-toggle">
            <button class="view-btn active" id="viewTable" title="Tabela" onclick="setView('table')"><i class="bi bi-list-ul"></i></button>
            <button class="view-btn" id="viewGrid" title="Grelha" onclick="setView('grid')"><i class="bi bi-grid-3x3-gap"></i></button>
          </div> --}}

          <button class="btn btn-outline btn-icon" title="Exportar CSV" onclick="alert('Exportar CSV — integrar com API Laravel')"><i class="bi bi-download"></i></button>
          <form action="{{ route('upload.files') }}  " method="POST" enctype="multipart/form-data" id="csvUploadForm">
          @csrf
          <input type="file" name="file" id="csvFileInput" accept=".csv" style="display: none;">
          <button type="button" class="btn btn-outline btn-icon   w-100" title="Importar CSV" onclick="document.getElementById('csvFileInput').click();">
              <i class="bi bi-upload"></i>IMPORTAR CSV
          </button>
      </form>

          <button class="btn btn-primary" onclick="openDrawer(null)">
            <i class="bi bi-plus-lg"></i> Novo produto
          </button>
        </div>
      </div>

      <!-- ─── BULK ACTION BAR ────────────── -->
      <div class="bulk-bar" id="bulkBar">
        <i class="bi bi-check2-square"></i>
        <span class="bulk-count" id="bulkCount">0</span>
        <span>produtos selecionados</span>
        <div class="bulk-spacer"></div>
        <button class="bulk-btn" onclick="alert('Repor stock dos selecionados')"><i class="bi bi-bag-plus"></i> Repor stock</button>
        <button class="bulk-btn" onclick="alert('Exportar selecionados')"><i class="bi bi-download"></i> Exportar</button>
        <button class="bulk-btn bulk-danger" onclick="openConfirmModal()"><i class="bi bi-trash"></i> Eliminar</button>
        <button class="bulk-close" onclick="clearSelection()"><i class="bi bi-x-lg"></i></button>
      </div>

      <!-- ─── STATS BAR ──────────────────── -->
      @php
        $totalProdutos = $medicamentos->total();
        $normal = $medicamentos->filter(function($m) { return $m->total_stock >= 20; })->count();
        $baixo = $medicamentos->filter(function($m) { return $m->total_stock >= 8 && $m->total_stock < 20; })->count();
        $critico = $medicamentos->filter(function($m) { return $m->total_stock > 0 && $m->total_stock < 8; })->count();
        $esgotado = $medicamentos->filter(function($m) { return $m->total_stock == 0; })->count();
        $valorTotal = $medicamentos->sum(function($m) { return $m->preco * $m->total_stock; });
      @endphp

      <div class="stats-bar">
        <span class="stat-total" id="totalCount">{{ $totalProdutos }} produto{{ $totalProdutos != 1 ? 's' : '' }}</span>
        <div class="stat-divider"></div>
        <div class="stat-item">
          <div class="stat-dot" style="background:var(--success)"></div>
          <span class="stat-label">Normal:</span>
          <span class="stat-val" id="statNormal">{{ $normal }}</span>
        </div>
        <div class="stat-item">
          <div class="stat-dot" style="background:var(--warning)"></div>
          <span class="stat-label">Baixo:</span>
          <span class="stat-val" id="statLow">{{ $baixo }}</span>
        </div>
        <div class="stat-item">
          <div class="stat-dot" style="background:var(--danger)"></div>
          <span class="stat-label">Crítico:</span>
          <span class="stat-val" id="statCritical">{{ $critico }}</span>
        </div>
        <div class="stat-item">
          <div class="stat-dot" style="background:var(--text-4)"></div>
          <span class="stat-label">Esgotado:</span>
          <span class="stat-val" id="statOut">{{ $esgotado }}</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
          <span class="stat-label">Valor total em stock:</span>
          <span class="stat-val">{{ number_format($valorTotal, 0, ',', '.') }} Kz</span>
        </div>
      </div>

      <!-- ─── TABLE WRAP ─────────────────── -->
      <div class="table-wrap" id="tableWrap">
        <div class="table-scroll">
          <table id="prodTable">
            <thead>
              <tr>
                <th class="col-check no-sort">
                  <input type="checkbox" class="row-check" id="selectAll" onchange="toggleAll(this)">
                </th>
                <th onclick="sortBy('name')" class="sorted">Produto <i class="bi bi-arrow-up sort-icon"></i></th>
                <th onclick="sortBy('cat')">Categoria <i class="bi bi-arrow-up-down sort-icon"></i></th>
                <th onclick="sortBy('stock')">Stock <i class="bi bi-arrow-up-down sort-icon"></i></th>
                <th onclick="sortBy('status')" class="no-sort">Estado</th>
                <th onclick="sortBy('price')">Preço venda <i class="bi bi-arrow-up-down sort-icon"></i></th>
                <th onclick="sortBy('expiry')">Validade <i class="bi bi-arrow-up-down sort-icon"></i></th>
                <th >Requer Receita Médica <i class="bi bi-arrow-up-down sort-icon"></i></th>
                <th class="no-sort"></th>
              </tr>
            </thead>
            <tbody id="prodBody">
              @forelse($medicamentos as $medicamento)
                @php
                  $categoria = $medicamento->categoria->name ?? 'Outro';
                  $categoriaSlug = strtolower(str_replace(' ', '-', $categoria));
                 $totalStock = $medicamento->total_stock ?? 0;
                  $validadeProxima = $medicamento->data_validade ? \Carbon\Carbon::parse($medicamento->data_validade) : null;
                  
                  if ($totalStock == 0) {
                      $status = 'out';
                      $statusClass = 'tag-out';
                      $statusLabel = 'Esgotado';
                  } elseif ($totalStock < 8) {
                      $status = 'critical';
                      $statusClass = 'tag-critical';
                      $statusLabel = 'Crítico';
                  } elseif ($totalStock < 20) {
                      $status = 'low';
                      $statusClass = 'tag-low';
                      $statusLabel = 'Baixo';
                  } else {
                      $status = 'ok';
                      $statusClass = 'tag-ok';
                      $statusLabel = 'Normal';
                  }
                  
                  $barPct = min(100, round(($totalStock / 50) * 100));
                  $barCol = $status == 'ok' ? 'var(--success)' : ($status == 'low' ? 'var(--warning)' : ($status == 'critical' ? 'var(--danger)' : 'var(--text-4)'));
                  
                  $now = now();
                  $expiryHtml = '';
                  if ($validadeProxima) {
                      $diffM = $validadeProxima->diffInMonths($now, false);
                      if ($diffM < 0) {
                          $expiryHtml = '<span style="color:var(--danger);font-weight:600">' . $validadeProxima->format('Y-m') . ' <i class="bi bi-exclamation-circle-fill" style="font-size:.65rem"></i></span>';
                      } elseif ($diffM < 3) {
                          $expiryHtml = '<span style="color:var(--warning);font-weight:600">' . $validadeProxima->format('Y-m') . ' <i class="bi bi-exclamation-triangle-fill" style="font-size:.65rem"></i></span>';
                      } else {
                          $expiryHtml = '<span style="color:var(--text-3)">' . $validadeProxima->format('Y-m') . '</span>';
                      }
                  } else {
                      $expiryHtml = '<span style="color:var(--text-4)">—</span>';
                  }
                @endphp
                <tr data-id="{{ $medicamento->id }}">
                  <td class="col-check">
                    <input type="checkbox" class="row-check" onchange="toggleRow({{ $medicamento->id }}, this)">
                  </td>
                  <td>
                    <div class="prod-cell">
                      <div class="prod-ico {{ $categoriaSlug }}">
                        <i class="bi bi-capsule"></i>
                      </div>
                      <div>
                        <div class="prod-name">{{ $medicamento->name }}</div>
                        <div class="prod-sku">FC-{{ str_pad($medicamento->id, 4, '0', STR_PAD_LEFT) }}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="cat-badge" style="background:var(--accent-light);color:var(--accent-2)">
                      {{ $categoria }}
                    </span>
                  </td>
                  <td class="stock-cell">
                    <div class="stock-qty">{{ $totalStock }} un.</div>
                    <div class="stock-bar-wrap">
                      <div class="stock-bar" style="width:{{ $barPct }}%;background:{{ $barCol }}"></div>
                    </div>
                  </td>
                  <td><span class="tag {{ $statusClass }}">{{ $statusLabel }}</span></td>
                  <td>
                    <div class="price-val">{{ number_format($medicamento->preco, 0, ',', '.') }} Kz</div>
                    <span class="price-unit">por unidade</span>
                  </td>
                  <td>{!! $expiryHtml !!}</td>
                  <td ><b>{{ $medicamento->requer_receita ? 'SIM' : 'NÃO' }}</b></td>
                  <td>
                    <div class="row-actions">
                      <button class="act-btn" title="Editar" onclick="openDrawer({{ $medicamento->id }})"><i class="bi bi-pencil"></i></button>
                      <button class="act-btn" title="Ajuste de inventário" onclick="abrirModalAjuste({{ $medicamento->id }}, '{{ addslashes($medicamento->name) }}')">
                          <i class="bi bi-bag-plus"></i>
                      </button>
                      {{-- <button class="act-btn" title="Ajuste de inventário" ><i class="bi bi-bag-plus"></i></button> --}}
                      {{-- <button class="act-btn" title="Ver histórico" onclick="alert('Histórico de movimentos')"><i class="bi bi-clock-history"></i></button> --}}
                      <form id="form-delete-{{ $medicamento->id }}" action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="act-btn danger" title="Eliminar" onclick="openConfirmSingle({{ $medicamento->id }}, '{{ $medicamento->name }}')">
                              <i class="bi bi-trash"></i>
                          </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" style="text-align:center;padding:32px;color:var(--text-4)">
                    Nenhum produto encontrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Empty state (mostrado quando sem resultados) -->
        <div class="empty-state" id="emptyState" style="display:none">
          <div class="empty-ico"><i class="bi bi-search"></i></div>
          <h3>Nenhum produto encontrado</h3>
          <p>Tenta ajustar os filtros ou o termo de pesquisa.</p>
        </div>

        <!-- Pagination -->
        <div class="table-footer">
          <div class="tf-left">
            <span>Mostrar</span>
            <select class="rows-select" onchange="...">
              <option value="10">10</option>
              <option value="25" selected>25</option>
              <option value="50">50</option>
            </select>
            <span>por página</span>
          </div>
          <div class="pagination" id="pagination">
            {{ $medicamentos->links('vendor.pagination.fc-pagination') }}
          </div>
        </div>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /layout -->

<!-- ══ DRAWER — Adicionar / Editar produto ════════ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div class="drawer-head">
    <h2 id="drawerTitle">Novo produto</h2>
    <button class="drawer-close" onclick="closeDrawer()"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="drawer-body" id="drawerBody">
    <form id="productForm" method="POST" action="{{ route('medicamentos.store') }}">
      @csrf
      <input type="hidden" name="_method" id="formMethod" value="POST">
      
      <div class="field-group-title">Identificação</div>
      <div class="form-row">
        <div class="form-group">
          <label>Nome comercial </label>
          <input type="text" name="name" id="fNome" class="form-input" placeholder="ex. Paracetamol" required>
        </div>

        <div class="form-group">
          <label>Descrição</label>
          <input type="text" name="descricao" id="fDescricao" class="form-input" placeholder="ex. Antibiótico oral">
        </div>

      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Preço (Kz) </label>
          <input type="number" name="preco" id="fPreco" class="form-input" min="0" step="0.01" placeholder="1000" required>
        </div>

        <div class="form-group">
          <label>Dosagem</label>
          <input type="text" name="dosagem" id="fDosagem" class="form-input" placeholder="ex. 200 mg">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Categoria </label>
          <select class="form-select" name="categoria_id" id="fCat" required>
            <option value="">Selecionar categoria</option>
            @php
            $categorias = App\Models\Categoria::all();
            @endphp
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Forma farmacêutica</label>
          <select class="form-select" name="forma_farmaceutica" id="fForma">
            <option value="Comprimido">Comprimido</option>
            <option value="Cápsula">Cápsula</option>
            <option value="Xarope">Xarope</option>
            <option value="Injectável">Injectável</option>
            <option value="Pomada / Gel">Pomada / Gel</option>
            <option value="Gotas">Gotas</option>
            <option value="Outro">Outro</option>
          </select>
        </div>

        <div class="form-group">
            <label>Receita Médica</label>
            <select class="form-select" name="requer_receita" id="fReceita">
              <option value="0">Não</option>
              <option value="1">Sim</option>
            </select>
        </div>
      </div>


      <div class="field-group-title">Detalhes de Fabrico</div>
      <div class="form-row">
        <div class="form-group">
          <label>Data de Fabrico</label>
          <input type="date" name="data_fabricacao" id="fDataFabrico" class="form-input">
        </div>
        <div class="form-group">
          <label>Laboratório</label>
          <input type="text" name="laboratorio" id="fLaboratorio" class="form-input" placeholder="Ex: Pfizer, Roche">
        </div>
        <div class="form-group">
          <label>Origem</label>
          <select class="form-select" name="origem" id="fOrigem" required>
            <option value="indiano">Indiano</option>
            <option value="portugues">Português</option>
          </select>
        </div>
      </div>

      <div class="field-group-title">Quantidade & Validade</div>
      <div class="form-row">
        <div class="form-group">
          <label>Quantidade </label>
          <input type="number" name="quantidade" id="fQuantidade" class="form-input" min="0" placeholder="0" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Data de validade</label>
          <input type="date" name="data_validade" id="fDataValidade" class="form-input">
        </div>
        <div class="form-group">
          <label>Lote</label>
          <input type="text" name="lote" id="fLote" class="form-input" placeholder="ex. LOTE001">
        </div>
      </div>
      <div class="drawer-footer">
        <button class="btn btn-outline" onclick="closeDrawer()">Cancelar</button>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg"></i> Guardar produto</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL CONFIRMAR ELIMINAÇÃO ════════════════ -->
<div class="modal-overlay" id="confirmModal">
  <div class="modal-box">
    <div class="modal-ico"><i class="bi bi-trash"></i></div>
    <h3>Eliminar produtos?</h3>
    <p id="confirmText">Esta acção é permanente e não pode ser revertida.</p>
    <div class="modal-foot">
      <button class="btn btn-outline" onclick="document.getElementById('confirmModal').classList.remove('open')">Cancelar</button>
      <button class="btn" style="background:var(--danger);color:#fff;border-color:var(--danger)" onclick="confirmDelete()">
        <i class="bi bi-trash"></i> Eliminar
      </button>
    </div>
  </div>
</div>



<!-- Modal Ajuste de Inventário -->
<div class="modal-overlay" id="modalAjusteInventario" style="display: none;">
  <div class="modal-box" style="width: 420px;">
    <div class="modal-ico" style="background:var(--accent-light); color:var(--accent);">
      <i class="bi bi-bag-plus"></i>
    </div>
    <h3>Ajustes de inventário</h3>
    <p id="ajusteProdutoNome"></p>
    <form id="formAjusteInventario" method="POST">
      @csrf
      <input type="hidden" name="id" id="ajusteProdutoId">
      <div class="form-group" style="margin-bottom: 16px;">
        <label style="font-weight:600; margin-bottom:6px;">Quantidade </label>
        <input type="number" name="quantidade" id="ajusteQuantidade" class="form-input" step="1"  required>
        <small class="form-hint">O ajuste de stock é essencial para garantir a fiabilidade dos dados, evitar ruturas de stock e manter o controlo financeiro.</small>
      </div>
      {{-- <div class="form-group" style="margin-bottom: 16px;">
        <label style="font-weight:600; margin-bottom:6px;">Motivo (opcional)</label>
        <input type="text" name="motivo" id="ajusteMotivo" class="form-input" placeholder="ex: Reposição, devolução, quebra">
      </div> --}}
      <div class="modal-foot" style="margin-top: 8px;">
        <button type="button" class="btn btn-outline" onclick="fecharModalAjuste()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Confirmar ajuste</button>
      </div>
    </form>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Quando um ficheiro for selecionado, submete o formulário
    document.getElementById('csvFileInput').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('csvUploadForm').submit();
        }
    });
</script>

<script>
/* ══ DADOS DO BACKEND ═══════════════════════════ */
let allProducts = @json($medicamentos->items()).map(m => ({
  id: m.id,
  name: m.name,
  descricao: m.descricao || '',
  cat: m.categoria?.name || 'Outro',
  catId: m.categoria_id,
  price: m.preco || 0,
  stock: m.total_stock || 0,
  expiry: m.validade_proxima ? m.validade_proxima.substring(0, 7) : null,
  data_validade: m.data_validade || '',
  lote: m.lote || '',
  dosagem: m.dosagem || '',
  forma_farmaceutica: m.forma_farmaceutica || 'Comprimido',
  status: m.total_stock === 0 ? 'out' : m.total_stock < 8 ? 'critical' : m.total_stock < 20 ? 'low' : 'ok',
}));

/* ══ STATE ══════════════════════════════════════════ */
let filtered    = [...allProducts];
let currentPage = 1;
let currentCat  = 'all';
let currentSort = { key: 'name', dir: 'asc' };
let selected    = new Set();
let editingId   = null;

/* ══ RENDER ═════════════════════════════════════════ */
function getRowsPerPage() { return parseInt(document.getElementById('rowsPerPage').value); }

function render() {
  const rpp   = getRowsPerPage();
  const total = filtered.length;
  const pages = Math.max(1, Math.ceil(total / rpp));
  if (currentPage > pages) currentPage = pages;
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);

  const tbody = document.getElementById('prodBody');
  if (!tbody) return;
  
  tbody.innerHTML = '';

  if (slice.length === 0) {
    const emptyState = document.getElementById('emptyState');
    if (emptyState) emptyState.style.display = 'flex';
    const tableScroll = document.querySelector('.table-scroll');
    if (tableScroll) tableScroll.style.display = 'none';
  } else {
    const emptyState = document.getElementById('emptyState');
    if (emptyState) emptyState.style.display = 'none';
    const tableScroll = document.querySelector('.table-scroll');
    if (tableScroll) tableScroll.style.display = '';
  }

  slice.forEach(p => {
    const isSelected = selected.has(p.id);
    const tagMap = { ok:'tag-ok', low:'tag-low', critical:'tag-critical', out:'tag-out' };
    const lblMap = { ok:'Normal', low:'Stock baixo', critical:'Crítico', out:'Esgotado' };
    const barPct = Math.min(100, Math.round((p.stock / 50) * 100));
    const barCol = p.status === 'ok' ? 'var(--success)' : p.status === 'low' ? 'var(--warning)' : p.status === 'critical' ? 'var(--danger)' : 'var(--text-4)';

    // Validade — alerta se < 3 meses
    let expiryHtml = '<span style="color:var(--text-4)">—</span>';
    if (p.expiry) {
      const [ey, em] = p.expiry.split('-').map(Number);
      const expDate = new Date(ey, em-1, 1);
      const diffM = (expDate - new Date()) / (1000*60*60*24*30);
      if (diffM < 0) {
        expiryHtml = `<span style="color:var(--danger);font-weight:600">${p.expiry} <i class="bi bi-exclamation-circle-fill" style="font-size:.65rem"></i></span>`;
      } else if (diffM < 3) {
        expiryHtml = `<span style="color:var(--warning);font-weight:600">${p.expiry} <i class="bi bi-exclamation-triangle-fill" style="font-size:.65rem"></i></span>`;
      } else {
        expiryHtml = `<span style="color:var(--text-3)">${p.expiry}</span>`;
      }
    }

    tbody.innerHTML += `
      <tr data-id="${p.id}" class="${isSelected ? 'selected' : ''}">
        <td class="col-check">
          <input type="checkbox" class="row-check" ${isSelected ? 'checked' : ''} onchange="toggleRow(${p.id}, this)">
        </td>
        <td>
          <div class="prod-cell">
            <div class="prod-ico outro">
              <i class="bi bi-capsule"></i>
            </div>
            <div>
              <div class="prod-name">${p.name}</div>
              ${p.dosagem ? `<div class="prod-sku">${p.dosagem}</div>` : ''}
            </div>
          </div>
        </td>
        <td>
          <span class="cat-badge" style="background:var(--accent-light);color:var(--accent-2)">
            ${p.cat}
          </span>
        </td>
        <td class="stock-cell">
          <div class="stock-qty">${p.stock} un.</div>
          <div class="stock-bar-wrap">
            <div class="stock-bar" style="width:${barPct}%;background:${barCol}"></div>
          </div>
        </td>
        <td><span class="tag ${tagMap[p.status]}">${lblMap[p.status]}</span></td>
        <td>
          <div class="price-val">${p.price.toLocaleString('pt-AO')} Kz</div>
        </td>
        <td>${expiryHtml}</td>
        <td>
          <div class="row-actions">
            <button class="act-btn" title="Editar" onclick="openDrawer(${p.id})"><i class="bi bi-pencil"></i></button>
            <button class="act-btn" title="Repor stock" onclick="alert('Repor stock de ${p.name}')"><i class="bi bi-bag-plus"></i></button>
           <button onclick="confirmDelete()" class="btn-danger">Confirmar</button>
           <button onclick="document.getElementById('confirmModal').classList.remove('open')">Cancelar</button>
          </div>
        </td>
      </tr>`;
  });

  // Stats bar
  const statNormal = document.getElementById('statNormal');
  const statLow = document.getElementById('statLow');
  const statCritical = document.getElementById('statCritical');
  const statOut = document.getElementById('statOut');
  
  if (statNormal) statNormal.textContent = allProducts.filter(p => p.status === 'ok').length;
  if (statLow) statLow.textContent = allProducts.filter(p => p.status === 'low').length;
  if (statCritical) statCritical.textContent = allProducts.filter(p => p.status === 'critical').length;
  if (statOut) statOut.textContent = allProducts.filter(p => p.status === 'out').length;

  // Page info
  const end = Math.min(start + rpp, total);
  const pageInfo = document.getElementById('pageInfo');
  if (pageInfo) {
    pageInfo.textContent = total === 0
      ? '0 resultados'
      : `${start+1}–${end} de ${total}`;
  }

  renderPagination(pages);
  updateSelectAll();
}

function renderPagination(pages) {
  const pg = document.getElementById('pagination');
  if (!pg) return;
  
  pg.innerHTML = '';
  const add = (label, page, disabled, active) => {
    const b = document.createElement('button');
    b.className = 'pg-btn' + (active ? ' active' : '');
    b.innerHTML = label; b.disabled = disabled;
    if (!disabled && !active) b.onclick = () => changePage(page);
    pg.appendChild(b);
  };
  add('<i class="bi bi-chevron-double-left"></i>', 1, currentPage===1);
  add('<i class="bi bi-chevron-left"></i>', currentPage-1, currentPage===1);

  let lo = Math.max(1, currentPage-2), hi = Math.min(pages, currentPage+2);
  if (lo > 1) { add('1', 1, false); if (lo > 2) pg.insertAdjacentHTML('beforeend','<span class="pg-ellipsis">…</span>'); }
  for (let i = lo; i <= hi; i++) add(i, i, false, i===currentPage);
  if (hi < pages) { if (hi < pages-1) pg.insertAdjacentHTML('beforeend','<span class="pg-ellipsis">…</span>'); add(pages, pages, false); }

  add('<i class="bi bi-chevron-right"></i>', currentPage+1, currentPage===pages);
  add('<i class="bi bi-chevron-double-right"></i>', pages, currentPage===pages);
}

/* ══ FILTER & SORT ══════════════════════════════════ */
function applyFilters() {
  const searchInput = document.getElementById('searchInput');
  const stockFilter = document.getElementById('stockFilter');
  
  const q = searchInput ? searchInput.value.trim().toLowerCase() : '';
  const sf = stockFilter ? stockFilter.value : 'all';
  
  filtered = allProducts.filter(p => {
    const matchQ   = !q || p.name.toLowerCase().includes(q);
    const matchCat = currentCat === 'all' || (p.cat && p.cat.toLowerCase().includes(currentCat));
    const matchS   = sf === 'all' || p.status === sf;
    return matchQ && matchCat && matchS;
  });
  applySort();
}

function applySort() {
  const { key, dir } = currentSort;
  filtered.sort((a, b) => {
    let va = a[key], vb = b[key];
    if (key === 'name') { 
      va = va ? va.toLowerCase() : '';
      vb = vb ? vb.toLowerCase() : '';
    }
    if (key === 'price' || key === 'stock') {
      va = Number(va) || 0;
      vb = Number(vb) || 0;
    }
    if (va < vb) return dir === 'asc' ? -1 : 1;
    if (va > vb) return dir === 'asc' ? 1 : -1;
    return 0;
  });
  currentPage = 1;
  render();
}

function filterTable() { applyFilters(); }

function filterCat(el, cat) {
  document.querySelectorAll('#catChips .chip').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
  currentCat = cat;
  applyFilters();
}

function sortTable() {
  const sortSelect = document.getElementById('sortSelect');
  if (!sortSelect) return;
  
  const v = sortSelect.value.split('-');
  currentSort = { key: v[0], dir: v[1] };
  applySort();
}

function changePage(p) { currentPage = p; render(); }

/* ══ SELECTION ══════════════════════════════════════ */
function toggleRow(id, cb) {
  if (cb.checked) selected.add(id); else selected.delete(id);
  const row = document.querySelector(`tr[data-id="${id}"]`);
  if (row) row.classList.toggle('selected', cb.checked);
  updateBulkBar(); updateSelectAll();
}

function toggleAll(cb) {
  const rpp   = getRowsPerPage();
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);
  slice.forEach(p => { if (cb.checked) selected.add(p.id); else selected.delete(p.id); });
  render();
  updateBulkBar();
}

function updateSelectAll() {
  const rpp   = getRowsPerPage();
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);
  const allSel = slice.length > 0 && slice.every(p => selected.has(p.id));
  const selectAll = document.getElementById('selectAll');
  if (selectAll) {
    selectAll.checked = allSel;
    selectAll.indeterminate = !allSel && slice.some(p => selected.has(p.id));
  }
}

function updateBulkBar() {
  const bar = document.getElementById('bulkBar');
  if (!bar) return;
  
  if (selected.size > 0) {
    bar.classList.add('show');
    const bulkCount = document.getElementById('bulkCount');
    if (bulkCount) bulkCount.textContent = selected.size;
  } else {
    bar.classList.remove('show');
  }
}

function clearSelection() {
  selected.clear();
  render();
  updateBulkBar();
}

/* ══ DRAWER ════════════════════════════════════════ */
function openDrawer(id) {
  editingId = id;
  const title = document.getElementById('drawerTitle');
  const formMethod = document.getElementById('formMethod');
  const productForm = document.getElementById('productForm');
  
  if (title) title.textContent = id ? 'Editar produto' : 'Novo produto';
  
  if (formMethod) {
    formMethod.value = id ? 'PUT' : 'POST';
  }
  

  if (id) {
    const p = allProducts.find(x => x.id === id);
    if (p) {
      document.getElementById('fNome')?.setAttribute('value', p.name || '');
      document.getElementById('fDescricao')?.setAttribute('value', p.descricao || '');
      document.getElementById('fPreco')?.setAttribute('value', p.price || '');
      document.getElementById('fCat')?.setAttribute('value', p.catId || '');
      document.getElementById('fForma')?.setAttribute('value', p.forma_farmaceutica || 'Comprimido');
      document.getElementById('fDosagem')?.setAttribute('value', p.dosagem || '');
      document.getElementById('fQuantidade')?.setAttribute('value', p.stock || '');
      document.getElementById('fDataValidade')?.setAttribute('value', p.data_validade || '');
      document.getElementById('fLote')?.setAttribute('value', p.lote || '');
    }
  } else {
    // Limpar formulário para novo produto
    document.getElementById('fNome')?.setAttribute('value', '');
    document.getElementById('fDescricao')?.setAttribute('value', '');
    document.getElementById('fPreco')?.setAttribute('value', '');
    document.getElementById('fCat')?.setAttribute('value', '');
    document.getElementById('fForma')?.setAttribute('value', 'Comprimido');
    document.getElementById('fDosagem')?.setAttribute('value', '');
    document.getElementById('fQuantidade')?.setAttribute('value', '');
    document.getElementById('fDataValidade')?.setAttribute('value', '');
    document.getElementById('fLote')?.setAttribute('value', '');
  }

  document.getElementById('drawerOverlay').classList.add('open');
  document.getElementById('drawer').classList.add('open');
}

function closeDrawer() {
  document.getElementById('drawerOverlay').classList.remove('open');
  document.getElementById('drawer').classList.remove('open');
  editingId = null;
}

function submitProductForm() {
  const form = document.getElementById('productForm');
  
  // Validação básica
  const nome = document.getElementById('fNome')?.value.trim();
  const preco = document.getElementById('fPreco')?.value.trim();
  const cat = document.getElementById('fCat')?.value;
  const quantidade = document.getElementById('fQuantidade')?.value.trim();
  
  if (!nome) {
    alert('Por favor, preencha o nome do produto.');
    document.getElementById('fNome')?.focus();
    return false;
  }
  
  if (!preco) {
    alert('Por favor, preencha o preço do produto.');
    document.getElementById('fPreco')?.focus();
    return false;
  }
  
  if (!cat) {
    alert('Por favor, selecione uma categoria.');
    document.getElementById('fCat')?.focus();
    return false;
  }
  
  if (!quantidade) {
    alert('Por favor, preencha a quantidade em stock.');
    document.getElementById('fQuantidade')?.focus();
    return false;
  }
  
  form.submit();
}

/* ══ DELETE ════════════════════════════════════════ */
let formToSubmit = null; // Guarda o ID do formulário selecionado

function openConfirmSingle(id, nome) {
  // Define qual formulário será enviado
  formToSubmit = `form-delete-${id}`;
  
  const confirmText = document.getElementById('confirmText');
  if (confirmText) {
    confirmText.textContent = `Tem a certeza que quer eliminar "${nome}"? Esta acção não pode ser revertida.`;
  }
  document.getElementById('confirmModal').classList.add('open');
}

function confirmDelete() {
  if (formToSubmit) {
    // Submete o formulário guardado
    document.getElementById(formToSubmit).submit();
  }
}

document.getElementById('confirmModal').addEventListener('click', function(e) {
  if (e.target === this) this.classList.remove('open');
});

/* ══ VIEW TOGGLE ═══════════════════════════════════ */
function setView(v) {
  const viewTable = document.getElementById('viewTable');
  const viewGrid = document.getElementById('viewGrid');
  
  if (viewTable) viewTable.classList.toggle('active', v === 'table');
  if (viewGrid) viewGrid.classList.toggle('active', v === 'grid');
}

/* ══ SIDEBAR ═══════════════════════════════════════ */
function setActive(el) {
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}

function toggleSub(id) { 
  const element = document.getElementById(id);
  if (element) element.classList.toggle('open'); 
}

/* ══ INIT ══════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
  if (typeof allProducts !== 'undefined' && allProducts.length > 0) {
    applyFilters();
  }
});

// Função para definir a categoria e submeter o formulário
function setCategoriaAndSubmit(categoria) {
    document.getElementById('categoriaHidden').value = categoria;
    document.getElementById('filterForm').submit();
}

// Submeter automaticamente quando os outros filtros mudarem
document.getElementById('stockFilter')?.addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});
document.getElementById('sortSelect')?.addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('filterForm').submit();
    }
});

// Abrir modal de ajuste de inventário
function abrirModalAjuste(id, nome) {
    const modal = document.getElementById('modalAjusteInventario');
    const form = document.getElementById('formAjusteInventario');
    const produtoId = document.getElementById('ajusteProdutoId');
    const produtoNome = document.getElementById('ajusteProdutoNome');
    const quantidadeInput = document.getElementById('ajusteQuantidade');
    // const motivoInput = document.getElementById('ajusteMotivo');

    produtoId.value = id;
    produtoNome.innerHTML = `<strong>${nome}</strong>`;
    quantidadeInput.value = '';
    // motivoInput.value = '';

    // Define a action do formulário dinamicamente
    let baseUrl = '{{ route("medicamentos.edit.stock", ["id" => ":id"]) }}';
    document.getElementById('formAjusteInventario').action = baseUrl.replace(':id', id);

    modal.style.display = 'flex';
}

function fecharModalAjuste() {
    document.getElementById('modalAjusteInventario').style.display = 'none';
}

// Fechar modal ao clicar fora
document.getElementById('modalAjusteInventario').addEventListener('click', function(e) {
    if (e.target === this) fecharModalAjuste();
});

// Validação antes de enviar
document.getElementById('formAjusteInventario').addEventListener('submit', function(e) {
    const quantidade = parseInt(document.getElementById('ajusteQuantidade').value);
    if (isNaN(quantidade) || quantidade === 0) {
        e.preventDefault();
        alert('Por favor, insira uma quantidade válida (diferente de zero).');
        return false;
    }
    // Se quiser permitir apenas valores positivos (devido à validação min:1 do backend original), descomente a linha abaixo:
    // if (quantidade < 0) {
    //     e.preventDefault();
    //     alert('O backend actual só permite adicionar stock (valores positivos). Contacte o administrador.');
    //     return false;
    // }
});
</script>
</body>
</html>