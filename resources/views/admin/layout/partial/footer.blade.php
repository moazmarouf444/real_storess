
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">
                {{awtTrans('حقوق النشر')}} &copy; {{\Carbon\Carbon::now()->year}}
                <a class="text-bold-800 grey darken-2" href="https://aait.sa/" target="_blank">,</a>
                {{awtTrans('كل الحقوق محفوظة')}}
            </span>
            <span class="float-md-right d-none d-md-block"> 
                <a href="https://aait.sa/" rel="follow" target="_blank">{{awtTrans('أوامر الشبكة')}}</a>
                <a href="mailto:sales@aait.sa" ><i class="feather icon-mail pink"></i></a> 
                <a href="tel:920005929" ><i class="feather icon-phone pink"></i></a> 
            </span>
        </p>
    </footer>

    <script src="{{asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/components.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    @yield('js')

    <x-admin.alert />
    <x-socket />
</body>
</html>