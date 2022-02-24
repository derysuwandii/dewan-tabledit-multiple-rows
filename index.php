<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>Table Edit Multiple Data | Dewan Komputer</title>
    <link rel="stylesheet" href="css/bootstrap-4.3.1.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
      <a class="navbar-brand text-white" href="index.php">
        Dewan Komputer
      </a>
    </nav>

    <div class="container">  
        <div class="table-responsive">  
            <h3 align="center" class="mt-3 mb-3">Update Multiple Row pada Tabel Menggunakan Ajax PHP</h3><br />
            <form method="post" id="update_form">
                <div align="left">
                    <button type="submit" name="multiple_update" id="multiple_update" class="btn btn-primary mb-4">
                        <i class="fa fa-save"></i>  Multiple Update
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%"></th>
                            <th width="20%">Name</th>
                            <th width="30%">alamat</th>
                            <th width="15%">jenkel</th>
                            <th width="20%">jabatan</th>
                            <th width="10%">umur</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
        </div>  
    </div>

    <div class="bg-secondary p-2 text-center text-white fixed-bottom">© <?php echo date('Y'); ?> Copyright:
        <a href="https://dewankomputer.com/"> Dewan Komputer</a>
    </div>

    <script>  
        $(document).ready(function(){
            fetch_data();
            function fetch_data(){
                $.ajax({
                    url:"ambil_data.php",
                    method:"POST",
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        for(var count = 0; count < data.length; count++)
                        {
                            html += '<tr>';
                            html += '<td><input type="checkbox" id="'+data[count].id+'" data-nama_lengkap="'+data[count].nama_lengkap+'" data-alamat="'+data[count].alamat+'" data-jenkel="'+data[count].jenkel+'" data-jabatan="'+data[count].jabatan+'" data-umur="'+data[count].umur+'" class="check_box"  /></td>';
                            html += '<td>'+data[count].nama_lengkap+'</td>';
                            html += '<td>'+data[count].alamat+'</td>';
                            html += '<td>'+data[count].jenkel+'</td>';
                            html += '<td>'+data[count].jabatan+'</td>';
                            html += '<td>'+data[count].umur+'</td></tr>';
                        }
                        $('tbody').html(html);
                    }
                });
            }

            $('#update_form').on('click', '.check_box', function(){
                var html = '';
                if(this.checked)
                {
                    html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-nama_lengkap="'+$(this).data('nama_lengkap')+'" data-alamat="'+$(this).data('alamat')+'" data-jenkel="'+$(this).data('jenkel')+'" data-jabatan="'+$(this).data('jabatan')+'" data-umur="'+$(this).data('umur')+'" class="check_box" checked /></td>';
                    html += '<td><input type="text" name="nama_lengkap[]" class="form-control" value="'+$(this).data("nama_lengkap")+'" /></td>';
                    html += '<td><input type="text" name="alamat[]" class="form-control" value="'+$(this).data("alamat")+'" /></td>';
                    html += '<td><select name="jenkel[]" id="jenkel_'+$(this).attr('id')+'" class="form-control"><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></td>';
                    html += '<td><input type="text" name="jabatan[]" class="form-control" value="'+$(this).data("jabatan")+'" /></td>';
                    html += '<td><input type="text" name="umur[]" class="form-control" value="'+$(this).data("umur")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
                } else {
                    html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-nama_lengkap="'+$(this).data('nama_lengkap')+'" data-alamat="'+$(this).data('alamat')+'" data-jenkel="'+$(this).data('jenkel')+'" data-jabatan="'+$(this).data('jabatan')+'" data-umur="'+$(this).data('umur')+'" class="check_box" /></td>';
                    html += '<td>'+$(this).data('nama_lengkap')+'</td>';
                    html += '<td>'+$(this).data('alamat')+'</td>';
                    html += '<td>'+$(this).data('jenkel')+'</td>';
                    html += '<td>'+$(this).data('jabatan')+'</td>';
                    html += '<td>'+$(this).data('umur')+'</td>';            
                }
                $(this).closest('tr').html(html);
                $('#jenkel_'+$(this).attr('id')+'').val($(this).data('jenkel'));
            });

            $('#update_form').on('submit', function(event){
                event.preventDefault();
                if($('.check_box:checked').length > 0){
                    $.ajax({
                        url:"multiple_update.php",
                        method:"POST",
                        data:$(this).serialize(),
                        success:function(data){
                            alert('Data Berhasil Diubah');
                            fetch_data();
                        }
                    })
                }
            });
        });  
    </script>

</body>
</html>