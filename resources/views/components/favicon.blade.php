@php
    use Illuminate\Support\Facades\DB;

    $company = DB::table('company_infos')->first();

    // Default favicon path
    $faviconPath = 'default/image/favicon/default_favicon.ico';
    $extension = 'ico';

    if (!empty($company) && !empty($company->favicon)) {
        $faviconPath = $company->favicon;
        $extension = pathinfo($company->favicon, PATHINFO_EXTENSION);
    }
@endphp

@switch($extension)
    @case('svg')
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/svg+xml">
    @break

    @case('png')
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
    @break

    @default
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
@endswitch
