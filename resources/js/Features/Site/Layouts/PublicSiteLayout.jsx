import { useState } from 'react';
import AppHeader from '../Components/AppHeader';
import { SITE_MICRO_LINKS, SITE_NAV_LINKS } from '../constants';

export default function PublicSiteLayout({ children }) {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    return (
        <div className="kbc-shell">
            <AppHeader
                isMobileMenuOpen={isMobileMenuOpen}
                onToggleMobileMenu={() => setIsMobileMenuOpen((prev) => !prev)}
                onCloseMobileMenu={() => setIsMobileMenuOpen(false)}
                microLinks={SITE_MICRO_LINKS}
                navLinks={SITE_NAV_LINKS}
            />

            <div className="kbc-content-wrap">{children}</div>
        </div>
    );
}
