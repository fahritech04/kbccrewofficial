import { Link, usePage } from '@inertiajs/react';

export default function AppHeader({
    isMobileMenuOpen,
    onToggleMobileMenu,
    onCloseMobileMenu,
    microLinks,
    navLinks,
}) {
    const currentUrl = usePage().url ?? '';

    const isNavItemActive = (href) => {
        if (!href || href === '#') {
            return false;
        }

        if (href === '/') {
            return currentUrl === '/';
        }

        return currentUrl === href || currentUrl.startsWith(`${href}/`);
    };

    return (
        <>
            <header className="kbc-microbar">
                <div className="kbc-micro-links">
                    {microLinks.map((item) => (
                        <a
                            key={typeof item === 'string' ? item : item.label}
                            href={typeof item === 'string' ? '#' : item.href}
                        >
                            {typeof item === 'string' ? item : item.label}
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
                    {navLinks.map((item) => {
                        const label = typeof item === 'string' ? item : item.label;
                        const href = typeof item === 'string' ? '#' : item.href;
                        const isActive = isNavItemActive(href);

                        return (
                            <Link
                                key={label}
                                href={href}
                                className={isActive ? 'is-active' : ''}
                                aria-current={isActive ? 'page' : undefined}
                                onClick={onCloseMobileMenu}
                            >
                                {label}
                            </Link>
                        );
                    })}
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

