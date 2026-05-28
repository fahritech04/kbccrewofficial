import { Head } from '@inertiajs/react';
import { STATISTICS_PAGE_TITLE } from '../Features/Statistics/constants';
import StatisticsPageContent from '../Features/Statistics/Pages/StatisticsPageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

const DEFAULT_SUMMARY = {
    total_matches: 0,
    scheduled_matches: 0,
    live_matches: 0,
    finished_matches: 0,
    average_total_points: 0,
};

export default function Statistics({ summary, topOffense, topDefense, topPointDiff }) {
    return (
        <>
            <Head title={STATISTICS_PAGE_TITLE} />

            <PublicSiteLayout>
                <StatisticsPageContent
                    summary={summary ?? DEFAULT_SUMMARY}
                    topOffense={topOffense}
                    topDefense={topDefense}
                    topPointDiff={topPointDiff ?? []}
                />
            </PublicSiteLayout>
        </>
    );
}
