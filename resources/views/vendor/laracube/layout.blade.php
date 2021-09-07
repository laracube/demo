<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N5SMVZG');</script>
        <!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('/vendor/laracube/img/favicon.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="{{ asset(mix('app.css', 'vendor/laracube')) }}" rel="stylesheet">
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5SMVZG"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="laracube">
            <v-app>
                <v-app-bar
                    app
                    flat
                    clipped-left
                    color="white"
                    class="lc-shadow z-50"
                >
                    <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
                    <v-row no-gutters>
                        <v-col>
                            @include('laracube::partials.logo')
                        </v-col>
                        <v-col>
                            @include('laracube::partials.user')
                        </v-col>
                    </v-row>
                </v-app-bar>
                <v-navigation-drawer
                    app
                    floating
                    clipped
                    color="lc-background"
                    v-model="drawer"
                >
                    @include('laracube::partials.navigation')
                </v-navigation-drawer>
                <v-main class="lc-background">
                    <v-container fluid class="pa-8">
                        <router-view :key="$route.path"></router-view>
                    </v-container>
                </v-main>
                <v-footer app color="lc-background">
                    @include('laracube::partials.footer')
                </v-footer>
            </v-app>
        </div>
        <!-- Global Laracube Object -->
        <script>
            window.LaracubeConfig = @json($laracubeConfig);
        </script>
        <script src="{{asset(mix('app.js', 'vendor/laracube'))}}"></script>
    </body>
</html>

