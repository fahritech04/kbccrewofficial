export default function FooterSection({ partners, footerBottomLinks }) {
    return (
        <footer className="kbc-footer">
            <section className="kbc-footer-partners">
                <div className="kbc-footer-partner-grid">
                    {partners.map(([brand, role]) => (
                        <article key={brand} className="kbc-footer-partner-card">
                            <h3>{brand}</h3>
                            <p>{role}</p>
                        </article>
                    ))}
                </div>
            </section>

            <section className="kbc-footer-bottom">
                <p>&copy; Kotabaru Basketball Competition 2026</p>
                <div className="kbc-footer-bottom-links">
                    {footerBottomLinks.map((item) => (
                        <a key={item} href="#">
                            {item}
                        </a>
                    ))}
                </div>
                <p>Kotabaru Basketball Competition</p>
            </section>
        </footer>
    );
}
