<?php 
global $wpdb;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <h1>Tes Ajax Page</h1>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="masukkan nama">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Tugas</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
    </br>
    </br>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Tugas</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="data_body">
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function(){
            load_data();
        });

        function load_data() {
            jQuery('#wrap-loading').show();
            jQuery.ajax({
                method: 'post',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                dataType: 'json',
                data:{
                    'action': 'get_data'
                },
                success: function(response) {
                    let html = '';
                    if(response.data.length > 0){
                        response.data.map(function(value, index){
                            html +='<tr>'
                                html +='<th scope="row">1</th>'
                                html +='<td>'+value.nama+'</td>'
                                html +='<td>'+value.tugas+'</td>'
                                html +='<td>Aksi</td>'
                            html +='</tr>';
                            console.log(value.nama);
                        })
                    }
                    jQuery('#data_body').html(html);
                    jQuery('#wrap-loading').hide();
                }
            });
        }
    </script>
</body>
</html>