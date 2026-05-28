import { Head } from '@inertiajs/react';
import { useState } from 'react';
import FooterSection from './Home/Components/FooterSection';
import Header from './Home/Components/Header';
import HeroSection from './Home/Components/HeroSection';
import MatchCentreSection from './Home/Components/MatchCentreSection';
import MediaSection from './Home/Components/MediaSection';
import SponsorStrip from './Home/Components/SponsorStrip';
import {
    ALERT_TEXT,
    FALLBACK_IMAGE,
    FOOTER_BOTTOM_LINKS,
    FOOTER_LINK_COLUMNS,
    HERO_NEWS_LIMIT,
    MEDIA_SECTIONS,
    MICRO_LINKS,
    NAV_LINKS,
    PARTNERS,
    SPONSORS,
} from './Home/constants';
import { buildSectionCards, formatDate, formatTime } from './Home/utils';

export default function Home({ featuredNews, news, standings, matches }) {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    const heroNews = news?.slice(0, HERO_NEWS_LIMIT) ?? [];
    const sectionCards = buildSectionCards(news, MEDIA_SECTIONS);

    return (
        <>
            <Head title="Kotabaru Basketball Competition" />

            <div className="kbc-shell">
                <Header
                    isMobileMenuOpen={isMobileMenuOpen}
                    onToggleMobileMenu={() => setIsMobileMenuOpen((prev) => !prev)}
                    onCloseMobileMenu={() => setIsMobileMenuOpen(false)}
                    microLinks={MICRO_LINKS}
                    navLinks={NAV_LINKS}
                />

                <div className="kbc-content-wrap">
                    <div className="kbc-alert">
                        <span>Latest:</span> {ALERT_TEXT}
                    </div>

                    <HeroSection
                        featuredNews={featuredNews}
                        heroNews={heroNews}
                        standings={standings}
                        fallbackImage={FALLBACK_IMAGE}
                    />

                    <SponsorStrip sponsors={SPONSORS} />

                    <MatchCentreSection
                        matches={matches}
                        formatDate={formatDate}
                        formatTime={formatTime}
                    />

                    {MEDIA_SECTIONS.map((section) => (
                        <MediaSection
                            key={section.key}
                            title={section.title}
                            cards={sectionCards[section.key] ?? []}
                        />
                    ))}

                    <FooterSection
                        partners={PARTNERS}
                        footerLinkColumns={FOOTER_LINK_COLUMNS}
                        footerBottomLinks={FOOTER_BOTTOM_LINKS}
                    />
                </div>
            </div>
        </>
    );
}

