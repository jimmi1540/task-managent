@include('inc.head');
<body>
    <div id="app">
        <div id="wrapper">
        @include('inc.sidebar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('inc.navbar')
                        <main style="width:100%">
                            @yield('content')
                        </main>
                </div>
            </div>
        </div>
    </div>
</body>
@include('inc.footer')
