import AppLayout from '@/Layouts/AppLayout';

export default function Dashboard() {
    return <div>This is dashboard</div>;
}

Dashboard.layout = (page) => <AppLayout children={page} title="Dashboard" />;
