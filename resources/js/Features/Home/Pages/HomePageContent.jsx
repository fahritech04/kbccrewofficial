import FooterSection from '../Components/FooterSection';
import HeroSection from '../Components/HeroSection';
import MatchCentreSection from '../Components/MatchCentreSection';
import MediaSection from '../Components/MediaSection';
import SponsorStrip from '../Components/SponsorStrip';
import {
    ALERT_TEXT,
    FOOTER_BOTTOM_LINKS,
    HERO_NEWS_LIMIT,
    MEDIA_SECTIONS,
    PARTNERS,
    SPONSORS,
} from '../constants';
import { buildSectionCards } from '../utils';
import { SITE_FALLBACK_IMAGE } from '../../Site/constants';
import { formatMatchDate, formatMatchTime } from '../../Site/utils/date';

export default function HomePageContent({ featuredNews, news, standings, matches }) {
    const heroNews = news?.slice(0, HERO_NEWS_LIMIT) ?? [];
    const sectionCards = buildSectionCards(news, MEDIA_SECTIONS);

    return (
        <>
            <div className="kbc-alert">
                <span>Latest:</span> {ALERT_TEXT}
            </div>

            <HeroSection
                featuredNews={featuredNews}
                heroNews={heroNews}
                standings={standings}
                fallbackImage={SITE_FALLBACK_IMAGE}
            />

            <SponsorStrip sponsors={SPONSORS} />

            <MatchCentreSection
                matches={matches}
                formatDate={formatMatchDate}
                formatTime={formatMatchTime}
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
                footerBottomLinks={FOOTER_BOTTOM_LINKS}
            />
        </>
    );
}
