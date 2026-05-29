import { Head } from '@inertiajs/react';
import PublicSiteLayout from './PublicSiteLayout';

export default function PublicPageLayout({ title, children }) {
    return (
        <>
            <Head title={title} />
            <PublicSiteLayout>{children}</PublicSiteLayout>
        </>
    );
}
