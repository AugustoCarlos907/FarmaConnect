{{-- resources/views/layouts/partials/footer.blade.php --}}

<style>
    /* ===================== FOOTER ===================== */
    .footer {
        background: #1f2f31;
        color: #fff;
        padding: 4rem 0 2rem;
    }

    .footer h3 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .footer h4 {
        font-weight: 700;
        margin-bottom: 1.3rem;
        color: #fff;
    }

    .footer a {
        color: #a0b9bc;
        text-decoration: none;
        transition: color 0.25s;
    }

    .footer a:hover {
        color: var(--accent);
    }

    .footer ul li {
        margin-bottom: 0.5rem;
    }

    .social-link {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 0.4rem;
        transition: all 0.25s;
        color: #a0b9bc;
        text-decoration: none;
        font-size: 1rem;
    }

    .social-link:hover {
        background: var(--accent);
        color: #fff;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        margin-bottom: 0.6rem;
        color: #a0b9bc;
    }

    .contact-item i {
        color: var(--accent);
        margin-top: 0.1rem;
        flex-shrink: 0;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.07);
        color: #6a8a8d;
        font-size: 0.88rem;
    }
</style>

<footer id="contact" class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h3>FarmaConnect</h3>
                <p style="color:#a0b9bc;line-height:1.75;font-size:.93rem;">
                    Plataforma angolana de busca e entrega de medicamentos. Conectamos farmácias e clientes em Luanda e futuramente em todo o país.
                </p>
                <div class="mt-3">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h4>Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Sobre nós</a></li>
                    <li><a href="#">Farmácias</a></li>
                    <li><a href="#">Medicamentos</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h4>Para farmácias</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Cadastrar farmácia</a></li>
                    <li><a href="#">Área do parceiro</a></li>
                    <li><a href="#">Planos</a></li>
                    <li><a href="#">Suporte</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Contacto</h4>
                <div class="contact-item"><i class="bi bi-telephone-fill"></i> +244 923 456 789</div>
                <div class="contact-item"><i class="bi bi-envelope-fill"></i> geral@farmaconnect.ao</div>
                <div class="contact-item"><i class="bi bi-geo-alt-fill"></i> Luanda, Angola</div>
                <div class="contact-item"><i class="bi bi-clock-fill"></i> Seg–Sex: 08h–20h | Sáb: 09h–18h</div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 FarmaConnect. Todos os direitos reservados.
        </div>
    </div>
</footer>