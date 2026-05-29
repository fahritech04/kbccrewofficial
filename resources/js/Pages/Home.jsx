import HomePageContent from '../Features/Home/Pages/HomePageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Home({ featuredNews, news, standings, matches }) {
    return (
        <PublicPageLayout title="Kotabaru Basketball Competition">
            <HomePageContent
                featuredNews={featuredNews}
                news={news}
                standings={standings}
                matches={matches}
            />
        </PublicPageLayout>
    );
}

