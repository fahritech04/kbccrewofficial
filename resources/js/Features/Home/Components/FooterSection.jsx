export default function FooterSection({ partners, footerLinkColumns, footerBottomLinks }) {
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

            <section className="kbc-footer-links">
                {footerLinkColumns.map((column, columnIndex) => (
                    <div key={columnIndex} className="kbc-footer-link-col">
                        {column.map((item) => (
                            <a key={item} href="#">
                                {item}
                            </a>
                        ))}
                    </div>
                ))}
            </section>

            <section className="kbc-footer-bottom">
                <p>© Kotabaru Basketball Competition 2026</p>
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

