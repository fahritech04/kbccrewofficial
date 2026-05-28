import { Head } from '@inertiajs/react';
import HomePageContent from '../Features/Home/Pages/HomePageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Home({ featuredNews, news, standings, matches }) {
    return (
        <>
            <Head title="Kotabaru Basketball Competition" />

            <PublicSiteLayout>
                <HomePageContent
                    featuredNews={featuredNews}
                    news={news}
                    standings={standings}
                    matches={matches}
                />
            </PublicSiteLayout>
        </>
    );
}

