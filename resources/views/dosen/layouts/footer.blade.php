</div>
<!-- End Page-content -->

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © King Pro P4W.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    BENEDIKTUS EKO WARAYAAN
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

</div>
<!-- end container-fluid -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{ asset('assetsAdmin/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assetsAdmin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assetsAdmin/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assetsAdmin/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assetsAdmin/libs/node-waves/waves.min.js') }}"></script>

@yield('js')

<script src="{{ asset('assetsAdmin/js/app.js') }}"></script>

{{-- Menu Prodi --}}
<script>
    $.ajax({
        url: "{{ route('prodi.index') }}",
        type: "get",
        datatype: "JSON",
        success:function(data){
            $.each(data, function(key, value){
                var url = '{{ route("jadwal.show", ":id") }}';
                url = url.replace(':id', value.id);
                $("#menuJadwal").append('<li><a href="'+url+'" id="jadwalProdi'+value.id+'" class="waves-effect">'+value.nm_prodi+'</a></li>');
            });
            let idProdi=$('#idProdi').data('id');
            $(document).ready(function(){
                $('#jadwalProdi'+idProdi).addClass("active");
            })

        }
    });
</script>


</body>

</html>
