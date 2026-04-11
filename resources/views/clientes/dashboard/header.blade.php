{{-- resources/views/layouts/partials/header.blade.php --}}
 <style>
    :root {
        --accent: #099aa7;
        --accent-dark: #067e8a;
        --heading: #1f2f31;
        --text: #363f40;
        --soft: #dff3f0;
        --mint: #eaf6f5;
        --muted: #6c8285;
        --border: #e4f0f0;
        --shadow: 0 8px 32px rgba(9,154,167,.08);
    }


    /* ========== HEADER ========== */
    .header {
        /* width: 95%;  */
        background: rgba(255,255,255,.97);
        backdrop-filter: blur(16px);
        box-shadow: 0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06);
        padding: .75rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: box-shadow .3s;
    }
    .header.scrolled {
        box-shadow: 0 2px 28px rgba(9,154,167,.14);
    }

    .sitename {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -.03em;
        line-height: 1;
        margin: 0;
    }
    .sitename .s1 { color: var(--accent); }
    .sitename .s2 { color: var(--heading); }

    .header-search {
        flex: 1;
        max-width: 560px;
    }
    .header-search .ig {
        border: 1.5px solid var(--border);
        border-radius: 50px;
        background: #f6fbfb;
        overflow: hidden;
        display: flex;
        align-items: center;
        transition: border-color .2s, box-shadow .2s;
    }
    .header-search .ig:focus-within {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(9,154,167,.1);
    }
    .header-search .ig-icon {
        padding: .6rem 0 .6rem 1.1rem;
        color: #a0b9bc;
        display: flex;
        align-items: center;
    }
    .header-search .search-form {
        display: flex;
        flex: 1;
        align-items: center;
        margin: 0;
        padding: 0;
    }
    .header-search .search-input {
        flex: 1;
        border: none;
        background: transparent;
        font-size: .9rem;
        color: var(--heading);
        padding: .6rem .5rem;
        outline: none;
        font-family: inherit;
    }
    .header-search .search-input::placeholder {
        color: #b0c4c6;
    }
    .header-search .search-btn {
        background: transparent;
        border: none;
        color: var(--accent);
        padding: 0 1rem 0 0.5rem;
        font-size: 1.25rem;
        line-height: 1;
        cursor: pointer;
        transition: color .2s;
        display: flex;
        align-items: center;
    }
    .header-search .search-btn:hover {
        color: var(--accent-dark);
    }

    .header-search .price-filter {
        margin-left: 0.5rem;
        padding-left: 0.5rem;
        border-left: 1px solid var(--border);
    }
    .header-search .price-label {
        font-size: 0.75rem;
        color: var(--muted);
        margin-right: 0.3rem;
    }
    .header-search .min-price-input {
        width: 90px;
    }

    .btn-outline-accent {
        border: 2px solid var(--accent);
        color: var(--accent);
        background: transparent;
        border-radius: 50px;
        font-size: 0.8rem;
        padding: 0.25rem 1rem;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-outline-accent:hover {
        background: var(--accent);
        color: #fff;
    }

    .navmenu ul {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        align-items: center;
    }
    .navmenu a {
        color: var(--heading);
        font-weight: 600;
        font-size: .88rem;
        padding: .42rem .85rem;
        border-radius: 50px;
        text-decoration: none;
        transition: .2s;
        white-space: nowrap;
    }
    .navmenu a:hover {
        background: var(--soft);
        color: var(--accent);
    }

    .hdr-icon {
        position: relative;
        color: var(--heading);
        font-size: 1.3rem;
        text-decoration: none;
        transition: color .2s;
    }
    .hdr-icon:hover {
        color: var(--accent);
    }
    .hdr-badge {
        position: absolute;
        top: -6px;
        right: -8px;
        background: var(--accent);
        color: #fff;
        font-size: .6rem;
        font-weight: 700;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    .profile-toggle {
        display: flex;
        align-items: center;
        gap: .5rem;
        text-decoration: none;
        color: var(--heading);
    }
    .profile-toggle .pname {
        font-weight: 600;
        font-size: .88rem;
    }

    /* Dropdown menu */
    .dropdown-menu {
        border: none;
        box-shadow: 0 12px 40px rgba(9,154,167,.12);
        border-radius: 18px;
        padding: .5rem;
        min-width: 180px;
    }
    .dropdown-item {
        border-radius: 10px;
        font-size: .9rem;
        font-weight: 500;
        padding: .55rem .9rem;
        transition: background .15s;
    }
    .dropdown-item:hover {
        background: var(--soft);
        color: var(--accent);
    }
    .dropdown-item.text-danger:hover {
        background: #fdecea;
        color: #c0392b;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .header-search {
            display: none;
        }
    }
</style>

@php
    $cartCount = $cartCount ?? (\App\Models\Carrinho::where('user_id', auth()->id())->count() ?? 0);
@endphp

<header class="header" id="mainHeader">
    <div class="container-xl">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('index.clientes') }}" class="text-decoration-none me-2 flex-shrink-0">
                <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
            </a>

            <div class="header-search d-none d-md-block mx-auto">
                <div class="ig">
                    <span class="ig-icon"><i class="bi bi-search"></i></span>
                    <form action="{{ route('medicamentos.search') }}" method="GET" class="search-form">
                        <input type="text" name="search" class="search-input" 
                            placeholder="Pesquise os medicamentos ..." 
                            value="{{ request('search') }}" required>

                        <button type="submit" class="search-btn" aria-label="Pesquisar">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                    </form>

                    <button type="button" class="btn-outline-accent ms-2" data-bs-toggle="modal" data-bs-target="#receitaModal">
                        <i class="bi bi-file-earmark-medical"></i> Receita
                    </button>
                </div>
            </div>

            <nav class="navmenu d-none d-lg-block flex-shrink-0">
                <ul>
                    <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
                    <li><a href="{{ route('farmacias.list') }}"><i class="bi bi-hospital"></i> Farmácias</a></li>
                    <li><a href="{{ route('produtos.clientes') }}"><i class="bi bi-box-seam"></i> Produtos</a></li>
                    <li><a href="{{ route('pedidos.clientes') }}"><i class="bi bi-clock-history"></i> Histórico</a></li>
                </ul>
            </nav>

            <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
                <a href="{{ route('carrinho.clientes') }}" class="hdr-icon d-none d-sm-inline-flex">
                    <i class="bi bi-cart"></i>
                    <span class="hdr-badge">{{ $cartCount }}</span>
                </a>

                <div class="dropdown">
                    <a href="#" class="profile-toggle dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=099aa7&color=fff&rounded=true&size=34"
                             width="34" height="34" class="rounded-circle" alt="">
                        @php
                            $nome = trim(auth()->user()->name);
                            $primeira = mb_substr($nome, 0, 1);
                            $ultima = mb_substr($nome, -1);
                            $resultado = mb_strtoupper($primeira . $ultima);
                        @endphp

                        {{-- <span class="pname d-none d-md-inline">{{ $resultado }}</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('perfil.clientes') }}"><i class="bi bi-person me-2"></i>Minha Conta</a></li>
                        <li><a class="dropdown-item" href="{{ route('pedidos.clientes') }}"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
                        <li><hr class="dropdown-divider mx-2 my-1"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout', ['id' => auth()->id()]) }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Terminar Sessão
                            </a>

                            <form id="logout-form" action="{{ route('logout', ['id' => auth()->id()]) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</header>

    <!-- Modal Upload Receita (fora do header, mas dentro do body) -->
    <div class="modal fade" id="receitaModal" tabindex="-1" aria-labelledby="receitaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('medicamentos.search.by.prescription') }}" method="POST" enctype="multipart/form-data" id="formReceita">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="receitaModalLabel"><i class="bi bi-camera"></i> Enviar receita médica</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="prescricaoImage" class="form-label">Tire uma foto ou faça upload da sua receita</label>
                            <input type="file" class="form-control" name="prescricao_image" id="prescricaoImage" accept="image/*" required>
                            <div class="form-text">Formatos aceites: JPG, PNG. Máx. 5MB.</div>
                        </div>
                        <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                            <img src="#" id="previewImg" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-accent">Pesquisar medicamentos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
    // Preview da imagem antes de enviar
    document.getElementById('prescricaoImage').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = document.getElementById('previewImg');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                img.src = ev.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.style.display = 'none';
            img.src = '#';
        }
    });

    // Efeito de scroll no header
    window.addEventListener('scroll', () => {
        const header = document.getElementById('mainHeader');
        if (header) header.classList.toggle('scrolled', window.scrollY > 50);
    });
</script>

