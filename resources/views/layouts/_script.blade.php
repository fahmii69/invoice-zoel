<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('AdminLTE/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js') }}">
</script>

<!-- DatetimeRangePicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<!-- Custom JS -->
<script type="text/javascript">
    function ribuan(value){
        var 	a = value;

        var	reverse = a.toString().split('').reverse().join(''),
            b 	= reverse.match(/\d{1,3}/g);
            b	= b.join(',').split('').reverse().join('');
            
            c='Rp. '+b;
            return c;
    }  

    /** add active class and stay opened when selected */
    var url = window.location;
    var dashboard = `{{ request()->path() }}`;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href + (dashboard == '/' ? '/' : "") == url.href;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href + (dashboard == '/' ? '/' : "") == url.href;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            background: 'gray',
            timer: 3500
        });

        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    Toast.fire({
                        icon: 'info',
                        title: '{{ Session::get('message') }}'
                    });
                    break;
                case 'warning':
                    Toast.fire({
                        icon: 'warning',
                        title: '{{ Session::get('message') }}'
                    });
                    break;
                case 'success':
                    Toast.fire({
                        icon: 'success',
                        title: '{{ Session::get('message') }}'
                    });
                    break;
                case 'error':
                    Toast.fire({
                        icon: 'error',
                        title: '{{ Session::get('message') }}'
                    });
                    break;
            }
        @endif

        @if(isset($errors->all()[0]))
            Toast.fire({
                // icon: 'error',
                title: '{{ $errors->all()[0] }}'
            });
        @endif
</script>
@stack('js');   