<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Entregadores</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
      --purple:        #7c3aed;
      --purple-light:  #ede9fe;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-sm:     0 1px 4px rgba(0,0,0,.06);
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --topbar-h:      52px;
      --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 18px;
    }

    html { font-size: 13px; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; -webkit-font-smoothing: antialiased; }
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ─────────────────────────── */
    .sidebar { width: 220px; flex-shrink: 0; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; z-index: 200; }
    .sidebar-header { height: var(--topbar-h); min-height: var(--topbar-h); flex-shrink: 0; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid var(--border); }
    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); } .logo-text .c { color: var(--text); }
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
    .nb-red { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
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
    .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 0 22px; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; flex-shrink: 0; }
    .tb-left { display: flex; align-items: center; gap: 8px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); }
    .tb-sub { font-size: 0.78rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }
    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }
    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; }

    /* ─── BUTTONS ─────────────────────────── */
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-success { background: var(--success); color: #fff; border-color: var(--success); }
    .btn-success:hover { background: #15803d; }
    .btn-danger { background: var(--danger); color: #fff; border-color: var(--danger); }
    .btn-danger:hover { background: #b91c1c; }
    .btn-icon { padding: 5px 8px; }

    /* ─── ACTION BAR ──────────────────────── */
    .action-bar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; flex-wrap: wrap; gap: 8px; }
    .ab-left { display: flex; align-items: center; gap: 8px; }
    .search-wrap { position: relative; }
    .search-wrap i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-4); font-size: 0.82rem; pointer-events: none; }
    .search-input { padding: 5px 10px 5px 30px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); width: 220px; transition: border-color .1s; }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }
    .filter-select { padding: 5px 26px 5px 9px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.77rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 8px center; color: var(--text-2); cursor: pointer; appearance: none; }
    .filter-select:focus { outline: none; border-color: var(--accent); }

    /* Status filter pills */
    .status-pills { display: flex; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-md); overflow: hidden; }
    .sp { padding: 5px 11px; font-size: 0.75rem; font-weight: 600; color: var(--text-3); cursor: pointer; border: none; background: none; font-family: 'DM Sans', sans-serif; transition: all .1s; white-space: nowrap; display: flex; align-items: center; gap: 4px; border-right: 1px solid var(--border); }
    .sp:last-child { border-right: none; }
    .sp:hover { background: var(--surface-2); color: var(--text); }
    .sp.active { background: var(--accent-light); color: var(--accent); }
    .sp .sc { font-size: 0.62rem; font-weight: 700; background: var(--border); color: var(--text-3); padding: 1px 5px; border-radius: 20px; }
    .sp.active .sc { background: var(--accent); color: #fff; }

    /* View toggle */
    .view-toggle { display: flex; border: 1px solid var(--border); border-radius: var(--r-md); overflow: hidden; }
    .vt-btn { padding: 5px 9px; font-size: 0.85rem; color: var(--text-3); cursor: pointer; border: none; background: var(--surface); transition: all .1s; }
    .vt-btn:hover { background: var(--surface-2); }
    .vt-btn.active { background: var(--accent-light); color: var(--accent); }

    /* ─── KPI ROW ─────────────────────────── */
    .kpi-row { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 11px; margin-bottom: 18px; }
    .kpi { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 13px 15px; position: relative; overflow: hidden; transition: border-color .15s, box-shadow .15s, transform .1s; cursor: pointer; }
    .kpi::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: var(--r-xl) 0 0 var(--r-xl); }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi.k-online::before  { background: var(--success); }
    .kpi.k-busy::before    { background: var(--warning); }
    .kpi.k-offline::before { background: var(--text-4); }
    .kpi.k-total::before   { background: var(--accent); }
    .kpi-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 9px; }
    .kpi-ico { width: 32px; height: 32px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 0.88rem; }
    .kpi-ico.green  { background: var(--success-light); color: var(--success); }
    .kpi-ico.amber  { background: var(--warning-light); color: var(--warning); }
    .kpi-ico.slate  { background: #f1f5f9; color: var(--text-3); }
    .kpi-ico.teal   { background: var(--accent-light); color: var(--accent); }
    .kpi-delta { font-size: 0.65rem; font-weight: 700; padding: 2px 5px; border-radius: 20px; }
    .d-up   { background: var(--success-light); color: #15803d; }
    .d-flat { background: #f1f5f9; color: var(--text-3); }
    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.55rem; font-weight: 700; line-height: 1; margin-bottom: 2px; }
    .kpi-lbl { font-size: 0.72rem; font-weight: 500; color: var(--text-3); }
    .kpi-sub { font-size: 0.67rem; color: var(--text-4); margin-top: 7px; padding-top: 7px; border-top: 1px solid var(--border); }

    /* ─── CARD GRID (view cards) ──────────── */
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 14px; }
    .del-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 16px; cursor: pointer; transition: border-color .15s, box-shadow .15s, transform .1s; position: relative; overflow: hidden; }
    .del-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
    .del-card.s-online::before  { background: var(--success); }
    .del-card.s-busy::before    { background: var(--warning); }
    .del-card.s-offline::before { background: var(--text-4); }
    .del-card:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }

    /* Avatar grande */
    .del-avatar-wrap { position: relative; display: inline-block; margin-bottom: 12px; }
    .del-avatar { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; }
    .status-ring { position: absolute; bottom: 1px; right: 1px; width: 13px; height: 13px; border-radius: 50%; border: 2px solid var(--surface); }
    .sr-online  { background: var(--success); }
    .sr-busy    { background: var(--warning); }
    .sr-offline { background: var(--text-4); }

    .del-card-name { font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 600; margin-bottom: 2px; }
    .del-card-role { font-size: 0.72rem; color: var(--text-3); margin-bottom: 10px; display: flex; align-items: center; gap: 5px; }

    .del-stats { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; margin-bottom: 12px; }
    .ds-item { background: var(--surface-2); border-radius: var(--r-md); padding: 7px 8px; text-align: center; }
    .ds-val { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text); line-height: 1; }
    .ds-lbl { font-size: 0.62rem; color: var(--text-4); margin-top: 2px; }

    .del-card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 10px; border-top: 1px solid var(--border); }
    .status-tag { display: inline-flex; align-items: center; gap: 4px; font-size: 0.67rem; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
    .st-online  { background: var(--success-light); color: var(--success); }
    .st-busy    { background: var(--warning-light); color: var(--warning); }
    .st-offline { background: #f1f5f9; color: var(--text-3); }
    .st-dot { width: 5px; height: 5px; border-radius: 50%; }
    .std-online  { background: var(--success); }
    .std-busy    { background: var(--warning); }
    .std-offline { background: var(--text-4); }

    .del-card-actions { display: flex; gap: 5px; }
    .ca-btn { width: 26px; height: 26px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.78rem; color: var(--text-3); transition: all .1s; }
    .ca-btn:hover { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .ca-btn.d:hover { border-color: #fca5a5; color: var(--danger); background: var(--danger-light); }

    /* Rating stars */
    .rating-stars { display: flex; align-items: center; gap: 2px; }
    .star { color: var(--warning); font-size: 0.65rem; }
    .star.empty { color: var(--border); }
    .rating-val { font-size: 0.72rem; font-weight: 600; color: var(--text-2); margin-left: 4px; }

    /* Current order badge */
    .current-order { background: var(--accent-light); border: 1px solid var(--accent-mid); border-radius: var(--r-md); padding: 6px 9px; font-size: 0.72rem; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
    .current-order i { color: var(--accent); font-size: 0.78rem; }
    .co-text { color: var(--accent-2); }
    .co-id { font-weight: 600; }

    /* Progress bar */
    .del-bar-wrap { height: 4px; background: var(--border); border-radius: 10px; margin-top: 6px; }
    .del-bar { height: 4px; border-radius: 10px; background: var(--accent); transition: width .4s; }

    /* ─── TABLE VIEW ──────────────────────── */
    .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); overflow: hidden; }
    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 0.78rem; min-width: 820px; }
    thead tr { background: var(--surface-2); }
    th { padding: 9px 12px; text-align: left; font-size: 0.66rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); white-space: nowrap; cursor: pointer; user-select: none; }
    th:hover { color: var(--text); }
    th.sorted { color: var(--accent); }
    th .si { font-size: 0.58rem; margin-left: 3px; opacity: .5; }
    th.sorted .si { opacity: 1; }
    th.ns { cursor: default; }
    th:first-child { padding-left: 16px; }
    th:last-child { padding-right: 16px; }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .07s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    td { padding: 11px 12px; vertical-align: middle; color: var(--text-2); }
    td:first-child { padding-left: 16px; }
    td:last-child { padding-right: 16px; }

    .tav { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: 0.72rem; font-weight: 700; flex-shrink: 0; position: relative; }
    .tav .tring { position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; border-radius: 50%; border: 1.5px solid var(--surface); }

    .del-name-cell { display: flex; align-items: center; gap: 10px; }
    .dn-name { font-weight: 600; color: var(--text); }
    .dn-phone { font-size: 0.67rem; color: var(--text-4); }

    .perf-bar-wrap { width: 80px; height: 5px; background: var(--border); border-radius: 10px; }
    .perf-bar { height: 5px; border-radius: 10px; }

    .row-actions { display: flex; align-items: center; gap: 4px; opacity: 0; transition: opacity .1s; }
    tbody tr:hover .row-actions { opacity: 1; }
    .act-btn { width: 25px; height: 25px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.77rem; color: var(--text-3); transition: all .1s; }
    .act-btn:hover { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .act-btn.d:hover { border-color: #fca5a5; color: var(--danger); background: var(--danger-light); }

    /* ─── DRAWER ──────────────────────────── */
    .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.35); z-index: 400; backdrop-filter: blur(1px); }
    .drawer-overlay.open { display: block; }
    .drawer { position: fixed; top: 0; right: -500px; width: 500px; max-width: 96vw; height: 100vh; background: var(--surface); border-left: 1px solid var(--border); display: flex; flex-direction: column; transition: right .25s cubic-bezier(.4,0,.2,1); z-index: 500; box-shadow: -8px 0 32px rgba(0,0,0,.1); }
    .drawer.open { right: 0; }
    .drawer-head { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 14px; flex-shrink: 0; }
    .drawer-head-av { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; flex-shrink: 0; position: relative; }
    .drawer-head-av .ring { position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; border-radius: 50%; border: 2px solid var(--surface); }
    .drawer-head-info { flex: 1; }
    .drawer-head-info h2 { font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 600; }
    .drawer-head-info p { font-size: 0.72rem; color: var(--text-3); margin-top: 2px; }
    .drawer-close { background: none; border: none; cursor: pointer; color: var(--text-3); font-size: 0.95rem; width: 28px; height: 28px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; transition: all .1s; flex-shrink: 0; }
    .drawer-close:hover { background: var(--surface-2); color: var(--text); }
    .drawer-body { flex: 1; overflow-y: auto; padding: 18px 20px; }
    .drawer-footer { padding: 12px 20px; border-top: 1px solid var(--border); display: flex; gap: 7px; justify-content: flex-end; flex-shrink: 0; }

    /* Drawer tabs */
    .d-tabs { display: flex; border-bottom: 1px solid var(--border); margin-bottom: 16px; gap: 0; }
    .d-tab { padding: 8px 14px; font-size: 0.78rem; font-weight: 600; color: var(--text-3); cursor: pointer; border: none; background: none; border-bottom: 2px solid transparent; margin-bottom: -1px; transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .d-tab:hover { color: var(--text); }
    .d-tab.active { color: var(--accent); border-bottom-color: var(--accent); }

    /* Drawer section */
    .d-section { margin-bottom: 18px; }
    .d-section-title { font-size: 0.7rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid var(--border); }
    .d-row { display: flex; align-items: flex-start; gap: 8px; padding: 7px 0; border-bottom: 1px solid var(--border); font-size: 0.8rem; }
    .d-row:last-child { border-bottom: none; }
    .d-lbl { font-size: 0.72rem; color: var(--text-3); width: 130px; flex-shrink: 0; padding-top: 1px; }
    .d-val { flex: 1; color: var(--text-2); font-weight: 500; }

    /* Stat boxes in drawer */
    .d-stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 14px; }
    .d-stat { background: var(--surface-2); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 10px 12px; text-align: center; }
    .d-stat-val { font-family: 'Sora', sans-serif; font-size: 1.3rem; font-weight: 700; color: var(--text); line-height: 1; }
    .d-stat-lbl { font-size: 0.65rem; color: var(--text-4); margin-top: 3px; }

    /* Mini order list in drawer */
    .mini-order { display: flex; align-items: center; gap: 9px; padding: 8px 10px; background: var(--surface-2); border: 1px solid var(--border); border-radius: var(--r-md); margin-bottom: 6px; font-size: 0.78rem; }
    .mo-id { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--accent-2); min-width: 56px; }
    .mo-client { flex: 1; font-weight: 500; color: var(--text); }
    .mo-status { font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; }
    .ms-route { background: var(--accent-light); color: var(--accent-2); }
    .ms-done  { background: var(--success-light); color: var(--success); }
    .mo-time { font-size: 0.67rem; color: var(--text-4); min-width: 40px; text-align: right; }

    /* Chart in drawer */
    .d-chart { height: 130px; position: relative; }

    /* Form in drawer */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px; }
    .form-row.single { grid-template-columns: 1fr; }
    .form-group { display: flex; flex-direction: column; gap: 4px; }
    .form-group label { font-size: 0.73rem; font-weight: 600; color: var(--text-2); }
    .form-input, .form-select { padding: 7px 10px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.79rem; font-family: 'DM Sans', sans-serif; color: var(--text); background: var(--surface); transition: border-color .1s; }
    .form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 9px center; padding-right: 28px; }
    .form-input:focus, .form-select:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .form-hint { font-size: 0.67rem; color: var(--text-4); }

    /* ─── MODAL ───────────────────────────── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.48); z-index: 600; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--r-xl); padding: 22px; width: 380px; max-width: 94vw; box-shadow: 0 20px 50px rgba(0,0,0,.18); animation: mIn .18s ease; }
    @keyframes mIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-ico { width: 38px; height: 38px; border-radius: var(--r-lg); display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 11px; }
    .modal-ico.danger { background: var(--danger-light); color: var(--danger); }
    .modal-box h3 { font-family: 'Sora', sans-serif; font-size: 0.93rem; font-weight: 600; margin-bottom: 5px; }
    .modal-box p { font-size: 0.78rem; color: var(--text-3); line-height: 1.5; margin-bottom: 16px; }
    .modal-foot { display: flex; gap: 7px; justify-content: flex-end; }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); grid-column: 1 / -1; }
    .empty-ico { width: 50px; height: 50px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 10px; }
    .empty-state h3 { font-size: 0.88rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p { font-size: 0.77rem; text-align: center; max-width: 220px; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 1024px) { .kpi-row { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: repeat(2,1fr); }
      .cards-grid { grid-template-columns: 1fr; }
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
                    <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div>
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
        <h1>Entregadores</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub" id="topbar-date">—</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
              <div><span class="u-name">{{ Auth::user()->farmacia->name ?? 'UNKNOWN'  }}</span><span class="u-role">{{ Auth::user()->name ?? 'Dr. António Silva' }}</span></div>
        </div>
      </div>
    </header>

    <div class="content">

      @php
        $onlineCount = $entregadores->where('status', 'online')->count();
        $busyCount = $entregadores->where('status', 'busy')->count();
        $offlineCount = $entregadores->where('status', 'offline')->count();
        $totalEntregasHoje = $entregadores->sum('entregas_hoje');
      @endphp

      <!-- ─── KPIs ──────────────────────────────── -->
      <div class="kpi-row">
        <div class="kpi k-online" onclick="setStatus('online')">
          <div class="kpi-head"><div class="kpi-ico green"><i class="bi bi-circle-fill"></i></div><span class="kpi-delta d-up">Disponíveis</span></div>
          <div class="kpi-val" id="kv-online">{{ $onlineCount }}</div><div class="kpi-lbl">Entregadores livres</div>
          <div class="kpi-sub" id="ks-online">{{ $onlineCount > 0 ? $onlineCount.' entregadores disponíveis' : 'Nenhum disponível' }}</div>
        </div>
        <div class="kpi k-busy" onclick="setStatus('busy')">
          <div class="kpi-head"><div class="kpi-ico amber"><i class="bi bi-bicycle"></i></div><span class="kpi-delta d-flat">Em rota</span></div>
          <div class="kpi-val" id="kv-busy">{{ $busyCount }}</div><div class="kpi-lbl">Em entrega agora</div>
          <div class="kpi-sub" id="ks-busy">{{ $busyCount }} pedidos em rota</div>
        </div>
        <div class="kpi k-offline" onclick="setStatus('offline')">
          <div class="kpi-head"><div class="kpi-ico slate"><i class="bi bi-moon"></i></div><span class="kpi-delta d-flat">Ausentes</span></div>
          <div class="kpi-val" id="kv-offline">{{ $offlineCount }}</div><div class="kpi-lbl">Offline / folga</div>
          <div class="kpi-sub">Indisponíveis hoje</div>
        </div>
        <div class="kpi k-total">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-check2-all"></i></div><span class="kpi-delta d-up"></span></div>
          <div class="kpi-val" id="kv-entregas">{{ $totalEntregasHoje }}</div><div class="kpi-lbl">Entregas hoje</div>
          <div class="kpi-sub">Total da equipa no dia</div>
        </div>
      </div>

      <!-- ─── ACTION BAR ───────────────────────── -->
      <div class="action-bar">
        <div class="ab-left">
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Pesquisar entregador…" oninput="applyFilters()">
          </div>
          <div class="status-pills">
            <button class="sp active" data-st="all" onclick="setSP(this,'all')">Todos <span class="sc" id="sc-all">{{ $entregadores->total() }}</span></button>
            <button class="sp" data-st="online" onclick="setSP(this,'online')"><i class="bi bi-circle-fill" style="font-size:.5rem;color:var(--success)"></i> Livre <span class="sc" id="sc-online">{{ $onlineCount }}</span></button>
            <button class="sp" data-st="busy" onclick="setSP(this,'busy')"><i class="bi bi-bicycle" style="font-size:.7rem"></i> Em rota <span class="sc" id="sc-busy">{{ $busyCount }}</span></button>
            <button class="sp" data-st="offline" onclick="setSP(this,'offline')"><i class="bi bi-moon" style="font-size:.65rem"></i> Offline <span class="sc" id="sc-offline">{{ $offlineCount }}</span></button>
          </div>
          <select class="filter-select" id="sortSel" onchange="applyFilters()">
            <option value="name">Nome A→Z</option>
            <option value="entregas-desc">Mais entregas hoje</option>
            <option value="rating-desc">Melhor avaliação</option>
            <option value="taxa-desc">Maior taxa entrega</option>
          </select>
        </div>
        <div style="display:flex;gap:7px">
          <div class="view-toggle">
            <button class="vt-btn active" id="btnCard" onclick="setView('card')"><i class="bi bi-grid-3x3-gap"></i></button>
            <button class="vt-btn" id="btnTable" onclick="setView('table')"><i class="bi bi-list-ul"></i></button>
          </div>
          <button class="btn btn-primary" onclick="openDrawer(null)"><i class="bi bi-plus-lg"></i> Novo entregador</button>
        </div>
      </div>

      <!-- ─── CARD VIEW ─────────────────────────── -->
      <div class="cards-grid" id="cardsGrid">
        @forelse($entregadores as $entregador)
          @php
            $statusInfo = [
              'online' => ['label'=>'Livre', 'class'=>'s-online', 'ring'=>'sr-online', 'tag'=>'st-online', 'dot'=>'std-online'],
              'busy' => ['label'=>'Em rota', 'class'=>'s-busy', 'ring'=>'sr-busy', 'tag'=>'st-busy', 'dot'=>'std-busy'],
              'offline' => ['label'=>'Offline', 'class'=>'s-offline', 'ring'=>'sr-offline', 'tag'=>'st-offline', 'dot'=>'std-offline'],
            ];
            $status = $statusInfo[$entregador->status] ?? $statusInfo['offline'];
            $initials = $entregador->user->name ? implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $entregador->user->name))) : '--';
            $bgColor = '#' . substr(md5($entregador->user->name ?? $entregador->id), 0, 6);
            $textColor = 'white';
          @endphp
          <div class="del-card {{ $status['class'] }}" onclick="openDrawer({{ $entregador->id }})">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px">
              <div class="del-avatar-wrap">
                <div class="del-avatar" style="background:{{ $bgColor }};color:{{ $textColor }}">{{ $initials }}</div>
                <div class="status-ring {{ $entregador->status }}"></div>
              </div>
              <div class="del-card-actions" onclick="event.stopPropagation()">
                <button class="ca-btn" title="Atribuir pedido" onclick="alert('Atribuir pedido a {{ $entregador->user->name }}')"><i class="bi bi-truck"></i></button>
                <button class="ca-btn" title="Contactar" onclick="alert('Contactar {{ $entregador->user->telefone ?? $entregador->user->phone ?? '--' }}')"><i class="bi bi-telephone"></i></button>
                <button class="ca-btn d" title="Remover" onclick="openRemove({{ $entregador->id }})"><i class="bi bi-person-dash"></i></button>
              </div>
            </div>
            <div class="del-card-name">{{ $entregador->user->name }}</div>
            <div class="del-card-role">
              <i class="bi {{ $entregador->veiculo == 'mota' ? 'bi-scooter' : ($entregador->veiculo == 'carro' ? 'bi-car-front' : ($entregador->veiculo == 'bicicleta' ? 'bi-bicycle' : 'bi-person-walking')) }}"></i> 
              matricula_veiculo : <b>{{ ucfirst($entregador->matricula_veiculo ?? 'não definido') }} </b>&nbsp;·&nbsp; 
            </div>

            @if($entregador->pedido_atual)
              <div class="current-order"><i class="bi bi-bicycle"></i><span class="co-text">A entregar <span class="co-id">{{ $entregador->pedido_atual }}</span></span></div>
            @endif
            
            <div class="del-stats">
              <div class="ds-item"><div class="ds-val">{{ $entregador->status }}</div><div class="ds-lbl">Estado</div></div>
              <div class="ds-item"><div class="ds-val">{{ $entregador->entregas_hoje ?? 0 }}</div><div class="ds-lbl">Hoje</div></div>
              <div class="ds-item"><div class="ds-val">{{ $entregador->entregas_mes ?? 0 }}</div><div class="ds-lbl">Mês</div></div>
              <div class="ds-item"><div class="ds-val">{{ $entregador->taxa_entrega ?? 100 }}%</div><div class="ds-lbl">Taxa</div></div>
            </div>

            @php $barPct = min(100, ($entregador->entregas_hoje ?? 0) / 20 * 100); @endphp
            <div class="del-bar-wrap" style="margin-top:8px"><div class="del-bar" style="width:{{ $barPct }}%"></div></div>
            <div style="display:flex;justify-content:space-between;font-size:.62rem;color:var(--text-4);margin-top:3px">
            </div>
          </div>
        @empty
          <div class="empty-state">
            <div class="empty-ico"><i class="bi bi-person-x"></i></div>
            <h3>Nenhum entregador encontrado</h3>
            <p>Adicione um novo entregador para começar.</p>
          </div>
        @endforelse
      </div>

      <!-- ─── TABLE VIEW ────────────────────────── -->
      <div class="table-wrap" id="tableWrap" style="display:none">
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th class="ns">Entregador</th>
                <th class="ns">Estado</th>
                <th onclick="sortCol('entregas')">Entregas hoje <i class="bi bi-arrow-up-down si"></i></th>
                <th onclick="sortCol('total')">Total mês <i class="bi bi-arrow-up-down si"></i></th>
                <th onclick="sortCol('taxa')">Taxa entrega <i class="bi bi-arrow-up-down si"></i></th>
                <th class="ns"></th>
              </tr>
            </thead>
            <tbody id="tableBody">
              @forelse($entregadores as $entregador)
                @php
                  $statusInfo = [
                    'online' => ['label'=>'Livre', 'tag'=>'st-online', 'dot'=>'std-online', 'ring'=>'sr-online'],
                    'busy' => ['label'=>'Em rota', 'tag'=>'st-busy', 'dot'=>'std-busy', 'ring'=>'sr-busy'],
                    'offline' => ['label'=>'Offline', 'tag'=>'st-offline', 'dot'=>'std-offline', 'ring'=>'sr-offline'],
                  ];
                  $status = $statusInfo[$entregador->status] ?? $statusInfo['offline'];
                  $initials = $entregador->user->name ? implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $entregador->user->name))) : '--';
                  $bgColor = '#' . substr(md5($entregador->user->name ?? $entregador->id), 0, 6);
                  $textColor = 'white';
                  $barPct = min(100, $entregador->taxa_entrega ?? 100);
                  $barCol = ($entregador->taxa_entrega ?? 100) >= 95 ? 'var(--success)' : (($entregador->taxa_entrega ?? 100) >= 80 ? 'var(--warning)' : 'var(--danger)');
                @endphp
                <tr onclick="openDrawer({{ $entregador->id }})" style="cursor:pointer">
                  <td>
                    <div class="del-name-cell">
                      <div class="tav" style="background:{{ $bgColor }};color:{{ $textColor }}">
                        {{ $initials }}
                        <div class="tring {{ $entregador->status }}"></div>
                      </div>
                      <div>
                        <div class="dn-name">{{ $entregador->user->name }}</div>
                        <div class="dn-phone">{{ $entregador->user->phone ?? '--' }}</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="status-tag {{ $entregador->status }}"><div class="st-dot"></div>{{$entregador->status }}</span></td>
                  <td><span style="font-family:'Sora',sans-serif;font-weight:700;font-size:.88rem">{{ $entregador->entregas_hoje ?? 0 }}</span></td>
                  <td>{{ $entregador->entregas_mes ?? 0 }}</td>
                  <td>
                    <div style="font-weight:600;font-size:.8rem;margin-bottom:3px">{{ $entregador->taxa_entrega ?? 100 }}%</div>
                    <div class="perf-bar-wrap"><div class="perf-bar" style="width:{{ $barPct }}%;background:{{ $barCol }}"></div></div>
                  </td>
                  <td>
                    
                  </td>
                  <td onclick="event.stopPropagation()">
                    <div class="row-actions">
                      <button class="act-btn" title="Ver perfil" onclick="openDrawer({{ $entregador->id }})"><i class="bi bi-eye"></i></button>
                      <button class="act-btn" title="Atribuir pedido" onclick="alert('Atribuir pedido a {{ $entregador->user->name }}')"><i class="bi bi-truck"></i></button>
                      <button class="act-btn" title="Contactar" onclick="alert('Contactar: {{ $entregador->user->phone ?? $entregador->tel ?? '--' }}')"><i class="bi bi-telephone"></i></button>
                      <button class="act-btn d" title="Remover" onclick="openRemove({{ $entregador->id }})"><i class="bi bi-person-dash"></i></button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr><td colspan="9" style="text-align:center;padding:32px;color:var(--text-4)">Nenhum entregador encontrado</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Paginação -->
      <div class="mt-4">
        {{ $entregadores->links() }}
      </div>

    </div>
  </div>
</div>

<!-- ══ DRAWER ════════════════════════════════════ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div class="drawer-head">
    <div class="drawer-head-av" id="dhAv"><div class="ring" id="dhRing"></div></div>
    <div class="drawer-head-info">
      <h2 id="dhName">Novo entregador</h2>
      <p id="dhSub"></p>
    </div>
    <button class="drawer-close" onclick="closeDrawer()"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="drawer-body">
    <div class="d-tabs">
      <button class="d-tab active" onclick="switchTab(this,'perfil')">Perfil</button>
      <button class="d-tab" onclick="switchTab(this,'desempenho')">Desempenho</button>
      <button class="d-tab" onclick="switchTab(this,'pedidos')">Pedidos</button>
    </div>
      <form  method="POST" action="">
      @csrf
        <div id="tabPerfil">
          <div class="d-section">
            <div class="d-section-title">Informação pessoal</div>
            <div class="form-row">
              <div class="form-group"><label>Nome completo *</label><input type="text" name="name" class="form-input" id="fNome" placeholder="ex. João Augusto"></div>
              <div class="form-group"><label>Email</label><input type="email" name="email" class="form-input" id="fBI" placeholder="00000000LA0000"></div>
            </div>
            <div class="form-row">
              <div class="form-group"><label>Password *</label><input type="password" name="password" class="form-input" id="fTel" placeholder="+244 9xx xxx xxx"></div>
              <div class="form-group"><label>Descrição</label><input type="text" name="descricao" class="form-input" id="fTel2" placeholder="+244 9xx xxx xxx"></div>
            </div>
            <div class="form-row single">
              <div class="form-group"><label>Nº BI </label><input type="text" name="numero_bi" class="form-input" id="fEmail" placeholder="entregador@email.com"></div>
            </div>
          </div>
          <div class="d-section">
            <div class="d-section-title">Veículo & Zona</div>
            <div class="form-row">
              <div class="form-group"><label>Matrícula Veículo</label><input type="text" name="matricula_veiculo" class="form-input" id="fMatricula" placeholder="LD-00-00-AA"></div>
              <div class="form-group"><label>Latitude</label><input type="text" name="latitude" class="form-input"  placeholder="-189432"></div>
              <div class="form-group"><label>Longitude</label><input type="text" name="longitude" class="form-input"  placeholder="120379"></div>
            </div>       
          </div>
                
        </div>

  </div>

  </div>
  <div class="drawer-footer">
    <button class="btn btn-outline" onclick="closeDrawer()">Cancelar</button>
    <button class="btn btn-primary" onclick="saveDeliverer()"><i class="bi bi-check-lg"></i> Guardar</button>
  </div>
</form>
</div>

<!-- ══ MODAL REMOVER ═════════════════════════════ -->
<div class="modal-overlay" id="removeModal">
  <div class="modal-box">
    <div class="modal-ico danger"><i class="bi bi-person-dash"></i></div>
    <h3>Remover entregador?</h3>
    <p id="removeText">Esta acção remove o entregador da lista activa.</p>
    <div class="modal-foot">
      <button class="btn btn-outline" onclick="document.getElementById('removeModal').classList.remove('open')">Cancelar</button>
      <button class="btn btn-danger" onclick="confirmRemove()"><i class="bi bi-person-dash"></i> Remover</button>
    </div>
  </div>
</div>

<script>
/* ══ DADOS DO BACKEND ═══════════════════════════ */
const entregadoresBackend = @json($entregadores->items());
let allDel = entregadoresBackend.map((d, i) => {
  const parts = (d.name || '').split(' ');
  const initials = (parts[0]?.[0] || '') + (parts[1]?.[0] || '');
  
  return {
    id: d.id,
    nome: d.name || 'Sem nome',
    tel: d.telefone || d.tel || '',
    status: d.status || 'offline',
    veiculo: d.veiculo || 'bicicleta',
    initials: initials || '--',
    palBg: '#' + (d.cor_fundo || Math.floor(Math.random()*16777215).toString(16).padStart(6, '0')),
    palText: 'white',
    entregasHoje: d.entregas_hoje || 0,
    entregasMes: d.entregas_mes || 0,
    taxa: d.taxa_entrega || 100,
    rating: d.avaliacao || 5.0,
    pedidoAtual: d.pedido_atual || null,
    bi: d.numero_bi || '',
    email: d.email || '',
    matricula: d.matricula_veiculo || '—',
    dataEntrada: d.created_at ? d.created_at.split('T')[0] : '',
    semana: d.semana ? JSON.parse(d.semana) : [0,0,0,0,0,0,0],
  };
});

/* ══ DATE ════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const n = new Date();
document.getElementById('topbar-date').textContent = `${DIAS[n.getDay()]}, ${n.getDate()} de ${MESES[n.getMonth()]} de ${n.getFullYear()}`;

/* ══ STATE ══════════════════════════════════════════ */
let filtered   = [...allDel];
let currentSt  = 'all';
let currentView = 'card';
let editingId   = null;
let removeId    = null;
let activeTab   = 'perfil';
let chartInst   = null;

/* ══ VEICULOS ═══════════════════════════════════════ */
const VEICULOS = { bicicleta:'Bicicleta', mota:'Motociclo', carro:'Automóvel', a_pe:'A pé' };
const VEICULO_ICONS = { bicicleta:'bi-bicycle', mota:'bi-scooter', carro:'bi-car-front', a_pe:'bi-person-walking' };

/* ══ STATUS INFO ═══════════════════════════════════ */
const STATUS_INFO = {
  online:  { label:'Livre',    cls:'st-online',  dot:'std-online',  ring:'sr-online',  kring:'ring' },
  busy:    { label:'Em rota',  cls:'st-busy',     dot:'std-busy',    ring:'sr-busy',    kring:'ring-busy' },
  offline: { label:'Offline',  cls:'st-offline',  dot:'std-offline', ring:'sr-offline', kring:'ring-off' },
};

/* ══ FILTER ══════════════════════════════════════════ */
function applyFilters() {
  const q = document.getElementById('searchInput').value.trim().toLowerCase();
  const sort = document.getElementById('sortSel').value;
  
  filtered = allDel.filter(d => {
    const mq = !q || d.nome.toLowerCase().includes(q) || d.zona.toLowerCase().includes(q);
    const ms = currentSt==='all' || d.status===currentSt;
    return mq && ms;
  });
  
  // Sort
  filtered.sort((a,b) => {
    if(sort==='name') return a.nome.localeCompare(b.nome);
    if(sort==='entregas-desc') return b.entregasHoje - a.entregasHoje;
    if(sort==='rating-desc')   return b.rating - a.rating;
    if(sort==='taxa-desc')     return b.taxa - a.taxa;
    return 0;
  });
  
  render();
}

function setStatus(st) { const el = document.querySelector(`.sp[data-st="${st}"]`); if(el) setSP(el,st); }
function setSP(el, st) {
  document.querySelectorAll('.sp').forEach(s=>s.classList.remove('active'));
  el.classList.add('active');
  currentSt = st;
  applyFilters();
}

/* ═══ RENDER ═══════════════════════════════════════ */
function render() {
  if(currentView==='card') renderCards();
  else renderTable();
}

function renderCards() {
  const grid = document.getElementById('cardsGrid');
  if(!filtered.length) {
    grid.innerHTML = `<div class="empty-state"><div class="empty-ico"><i class="bi bi-person-x"></i></div><h3>Nenhum entregador encontrado</h3><p>Ajusta o filtro ou pesquisa.</p></div>`;
    return;
  }
  
  grid.innerHTML = filtered.map(d => {
    const si = STATUS_INFO[d.status];
    const barPct = Math.min(100, Math.round((d.entregasHoje / 20) * 100));
    const orderBadge = d.pedidoAtual
      ? `<div class="current-order"><i class="bi bi-bicycle"></i><span class="co-text">A entregar <span class="co-id">${d.pedidoAtual}</span></span></div>`
      : '';
    return `
      <div class="del-card s-${d.status}" onclick="openDrawer(${d.id})">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px">
          <div class="del-avatar-wrap">
            <div class="del-avatar" style="background:${d.palBg};color:${d.palText}">${d.initials}</div>
            <div class="status-ring ${si.ring}"></div>
          </div>
          <div class="del-card-actions" onclick="event.stopPropagation()">
            <button class="ca-btn" title="Atribuir pedido" onclick="alert('Atribuir pedido a ${d.nome}')"><i class="bi bi-truck"></i></button>
            <button class="ca-btn" title="Contactar" onclick="alert('Contactar ${d.tel}')"><i class="bi bi-telephone"></i></button>
            <button class="ca-btn d" title="Remover" onclick="openRemove(${d.id})"><i class="bi bi-person-dash"></i></button>
          </div>
        </div>
        <div class="del-card-name">${d.nome}</div>
        <div class="del-card-role">
          <i class="bi ${VEICULO_ICONS[d.veiculo]}"></i> ${VEICULOS[d.veiculo]} &nbsp;·&nbsp; ${d.zona}
        </div>
        ${orderBadge}
        <div class="del-stats">
          <div class="ds-item"><div class="ds-val">${d.entregasHoje}</div><div class="ds-lbl">Hoje</div></div>
          <div class="ds-item"><div class="ds-val">${d.entregasMes}</div><div class="ds-lbl">Mês</div></div>
          <div class="ds-item"><div class="ds-val">${d.taxa}%</div><div class="ds-lbl">Taxa</div></div>
        </div>
        <div class="del-bar-wrap" style="margin-top:8px"><div class="del-bar" style="width:${barPct}%"></div></div>
        <div style="display:flex;justify-content:space-between;font-size:.62rem;color:var(--text-4);margin-top:3px">
          <span>${d.entregasHoje} entregas</span><span>meta 20</span>
        </div>
      </div>`;
  }).join('');
}

function renderTable() {
  const tbody = document.getElementById('tableBody');
  if(!filtered.length) { 
    tbody.innerHTML = `<tr><td colspan="9" style="text-align:center;padding:32px;color:var(--text-4)">Nenhum entregador encontrado</td></tr>`; 
    return; 
  }
  
  tbody.innerHTML = filtered.map(d => {
    const si = STATUS_INFO[d.status];
    const barPct = Math.min(100, d.taxa);
    const barCol = d.taxa >= 95 ? 'var(--success)' : d.taxa >= 80 ? 'var(--warning)' : 'var(--danger)';
    
    let stars = '';
    for(let i=1;i<=5;i++) {
      stars += `<i class="bi bi-star${i<=Math.round(d.rating)?'-fill':''}  star${i<=Math.round(d.rating)?'':' empty'}"></i>`;
    }
    
    return `
      <tr onclick="openDrawer(${d.id})" style="cursor:pointer">
        <td>
          <div class="del-name-cell">
            <div class="tav" style="background:${d.palBg};color:${d.palText}">
              ${d.initials}
              <div class="tring ${si.ring}"></div>
            </div>
            <div>
              <div class="dn-name">${d.nome}</div>
              <div class="dn-phone">${d.tel}</div>
            </div>
          </div>
        </td>
        <td><span class="status-tag ${si.cls}"><div class="st-dot ${si.dot}"></div>${si.label}</span></td>
        <td><span style="font-family:'Sora',sans-serif;font-weight:700;font-size:.88rem">${d.entregasHoje}</span></td>
        <td>${d.entregasMes}</td>
        <td>
          <div style="font-weight:600;font-size:.8rem;margin-bottom:3px">${d.taxa}%</div>
          <div class="perf-bar-wrap"><div class="perf-bar" style="width:${barPct}%;background:${barCol}"></div></div>
        </td>
        <td>
          <div class="rating-stars">
            ${stars}
            <span class="rating-val">${d.rating}</span>
          </div>
        </td>
        <td>${d.pedidoAtual ? `<span style="font-family:'Sora',sans-serif;font-weight:600;font-size:.78rem;color:var(--accent-2)">${d.pedidoAtual}</span>` : '<span style="color:var(--text-4)">—</span>'}</td>
        <td style="color:var(--text-3);font-size:.77rem">${d.zona}</td>
        <td onclick="event.stopPropagation()">
          <div class="row-actions">
            <button class="act-btn" title="Ver perfil" onclick="openDrawer(${d.id})"><i class="bi bi-eye"></i></button>
            <button class="act-btn" title="Atribuir pedido" onclick="alert('Atribuir pedido a ${d.nome}')"><i class="bi bi-truck"></i></button>
            <button class="act-btn" title="Contactar" onclick="alert('Contactar: ${d.tel}')"><i class="bi bi-telephone"></i></button>
            <button class="act-btn d" title="Remover" onclick="openRemove(${d.id})"><i class="bi bi-person-dash"></i></button>
          </div>
        </td>
      </tr>`;
  }).join('');
}

/* ══ VIEW ════════════════════════════════════════════ */
function setView(v) {
  currentView = v;
  document.getElementById('btnCard').classList.toggle('active', v==='card');
  document.getElementById('btnTable').classList.toggle('active', v==='table');
  document.getElementById('cardsGrid').style.display = v==='card' ? 'grid' : 'none';
  document.getElementById('tableWrap').style.display  = v==='table'? 'block' : 'none';
  render();
}

/* ══ DRAWER ══════════════════════════════════════════ */
function openDrawer(id) {
  editingId = id;
  const d = id ? allDel.find(x=>x.id===id) : null;
  activeTab = 'perfil';

  // Header
  if(d) {
    const si = STATUS_INFO[d.status];
    document.getElementById('dhAv').style.cssText = `background:${d.palBg};color:${d.palText};width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Sora',sans-serif;font-size:1rem;font-weight:700;flex-shrink:0;position:relative`;
    document.getElementById('dhAv').innerHTML = `${d.initials}<div class="ring ${si.ring}" style="position:absolute;bottom:0;right:0;width:12px;height:12px;border-radius:50%;border:2px solid var(--surface)"></div>`;
    document.getElementById('dhName').textContent = d.nome;
    document.getElementById('dhSub').innerHTML = `<span class="status-tag ${si.cls}" style="font-size:.68rem"><div class="st-dot ${si.dot}"></div>${si.label}</span> &nbsp;·&nbsp; ${VEICULOS[d.veiculo]}`;
    
    // Fill form
    document.getElementById('fNome').value = d.nome;
    document.getElementById('fBI').value = d.bi;
    document.getElementById('fTel').value = d.tel;
    document.getElementById('fTel2').value = '';
    document.getElementById('fEmail').value = d.email;
    document.getElementById('fVeiculo').value = d.veiculo;
    document.getElementById('fMatricula').value = d.matricula;
    document.getElementById('fZona').value = d.zona;
    document.getElementById('fStatus').value = d.status;
    document.getElementById('fData').value = d.dataEntrada;
    
  } else {
    document.getElementById('dhAv').innerHTML = `<i class="bi bi-person-plus" style="font-size:1.1rem;color:var(--text-3)"></i>`;
    document.getElementById('dhAv').style.cssText = 'background:var(--surface-2);border:1px solid var(--border);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0';
    document.getElementById('dhName').textContent = 'Novo entregador';
    document.getElementById('dhSub').textContent = 'Preencha os dados abaixo';
    
    // Clear form
    document.getElementById('fNome').value = '';
    document.getElementById('fBI').value = '';
    document.getElementById('fTel').value = '';
    document.getElementById('fTel2').value = '';
    document.getElementById('fEmail').value = '';
    document.getElementById('fVeiculo').value = 'bicicleta';
    document.getElementById('fMatricula').value = '';
    document.getElementById('fZona').value = 'Ingombotas';
    document.getElementById('fStatus').value = 'online';
    document.getElementById('fData').value = '';
  }

  // Tabs visibility
  document.querySelectorAll('.d-tab').forEach((t,i) => {
    t.style.display = d ? 'block' : (i===0?'block':'none');
  });
  switchTab(document.querySelector('.d-tab.active') || document.querySelector('.d-tab'), 'perfil', d);

  document.getElementById('drawerOverlay').classList.add('open');
  document.getElementById('drawer').classList.add('open');
}

function switchTab(el, tab, d) {
  if(!el) return;
  document.querySelectorAll('.d-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  ['tabPerfil','tabDesempenho','tabPedidos'].forEach(id => document.getElementById(id).style.display='none');

  const delObj = editingId ? allDel.find(x=>x.id===editingId) : null;

  if(tab==='perfil') {
    document.getElementById('tabPerfil').style.display='block';
  } else if(tab==='desempenho' && delObj) {
    document.getElementById('tabDesempenho').style.display='block';
    // Stats
    document.getElementById('dStatGrid').innerHTML = `
      <div class="d-stat"><div class="d-stat-val">${delObj.entregasHoje}</div><div class="d-stat-lbl">Entregas hoje</div></div>
      <div class="d-stat"><div class="d-stat-val">${delObj.entregasMes}</div><div class="d-stat-lbl">Este mês</div></div>
      <div class="d-stat"><div class="d-stat-val">${delObj.taxa}%</div><div class="d-stat-lbl">Taxa entrega</div></div>`;
    // Chart
    if(chartInst) { chartInst.destroy(); chartInst=null; }
    chartInst = new Chart(document.getElementById('dChart'), {
      type:'bar',
      data: { labels:['Seg','Ter','Qua','Qui','Sex','Sáb','Dom'], datasets:[{ data:delObj.semana, backgroundColor:'rgba(8,153,166,.75)', borderRadius:5, borderSkipped:false }] },
      options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ display:false } }, scales: { x:{ grid:{ display:false }, ticks:{ font:{ family:'DM Sans', size:10 }, color:'#94a3b8' } }, y:{ grid:{ color:'#f1f5f9' }, ticks:{ font:{ family:'DM Sans', size:10 }, color:'#94a3b8' }, beginAtZero:true } } }
    });
    // Metrics
    document.getElementById('dMetrics').innerHTML = `
      <div class="d-row"><span class="d-lbl">Avaliação média</span><span class="d-val">${delObj.rating} ★</span></div>
      <div class="d-row"><span class="d-lbl">Taxa de entrega</span><span class="d-val">${delObj.taxa}% das entregas concluídas</span></div>
      <div class="d-row"><span class="d-lbl">Total este mês</span><span class="d-val">${delObj.entregasMes} entregas</span></div>
      <div class="d-row"><span class="d-lbl">Zona de cobertura</span><span class="d-val">${delObj.zona}</span></div>
      <div class="d-row"><span class="d-lbl">Veículo</span><span class="d-val"><i class="bi ${VEICULO_ICONS[delObj.veiculo]}"></i> ${VEICULOS[delObj.veiculo]}</span></div>`;
  } else if(tab==='pedidos' && delObj) {
    document.getElementById('tabPedidos').style.display='block';
    document.getElementById('dOrders').innerHTML = '<div class="text-center p-4 text-secondary">Nenhum pedido recente</div>';
  }
}

function closeDrawer() {
  document.getElementById('drawerOverlay').classList.remove('open');
  document.getElementById('drawer').classList.remove('open');
  editingId = null;
  if(chartInst) { chartInst.destroy(); chartInst=null; }
}

function saveDeliverer() {
  const nome = document.getElementById('fNome').value.trim();
  if(!nome) { document.getElementById('fNome').focus(); return; }
  
  alert('Funcionalidade de guardar integrada com backend (seria chamada uma rota POST)');
  closeDrawer();
}

/* ══ REMOVE ══════════════════════════════════════════ */
function openRemove(id) {
  removeId = id;
  const d = allDel.find(x=>x.id===id);
  document.getElementById('removeText').textContent = `Vai remover "${d?.nome}" da equipa de entregadores. Esta acção não pode ser revertida.`;
  document.getElementById('removeModal').classList.add('open');
}

function confirmRemove() {
  alert('Funcionalidade de remover integrada com backend (seria chamada uma rota DELETE)');
  document.getElementById('removeModal').classList.remove('open');
  removeId = null;
}

document.getElementById('removeModal').addEventListener('click',function(e){if(e.target===this)this.classList.remove('open');});

/* ══ SIDEBAR ═════════════════════════════════════════ */
function setActive(el) { document.querySelectorAll('.nav-item.active').forEach(i=>i.classList.remove('active')); el.classList.add('active'); }
function toggleSub(id) { document.getElementById(id).classList.toggle('open'); }

/* ══ INIT ════════════════════════════════════════════ */
applyFilters();
</script>
</body>
</html>