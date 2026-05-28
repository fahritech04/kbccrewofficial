export default function Header({
    isMobileMenuOpen,
    onToggleMobileMenu,
    onCloseMobileMenu,
    microLinks,
    navLinks,
}) {
    return (
        <>
            <header className="kbc-microbar">
                <div className="kbc-micro-links">
                    {microLinks.map((item) => (
                        <a key={item} href="#">
                            {item}
                        </a>
                    ))}
                </div>
                <a href="#">Presented by @kbccrewofficial</a>
            </header>

            <header className="kbc-topbar">
                <div className="kbc-topbar-left">
                    <button
                        type="button"
                        className="kbc-menu-btn"
                        aria-label="Open menu"
                        aria-expanded={isMobileMenuOpen}
                        onClick={onToggleMobileMenu}
                    >
                        &#9776;
                    </button>
                    <div className="kbc-brand">
                        <div className="kbc-brand-mark">K</div>
                        <div>
                            <p className="kbc-brand-name">Kotabaru</p>
                            <p className="kbc-brand-tag">Basketball Competition</p>
                        </div>
                    </div>
                </div>

                <nav className={`kbc-nav ${isMobileMenuOpen ? 'is-open' : ''}`}>
                    {navLinks.map((item) => (
                        <a key={item} href="#" onClick={onCloseMobileMenu}>
                            {item}
                        </a>
                    ))}
                </nav>

                <div className="kbc-topbar-right">
                    <button type="button" className="kbc-signin-btn">
                        Sign in
                    </button>
                </div>
            </header>
        </>
    );
}

