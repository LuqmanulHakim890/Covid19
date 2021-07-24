<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Penyebaran Virus Covid-19</title>
  </head>
  <body>
        <div class="jumbotron jumbotron-fluid bg-danger text-white">
        <div class="container text-center">
          <h1 class="display-4">Corona Virus</h1>
          <p class="lead">
            <h2>
              PENYEBARAN VIRUS COVID-19
              <br> Jaga Kesehatan Dan Jangan Lupa Protokol Kesehatan 
            </h2>
          </p>
        </div>
        </div>

                <style type="text/css">
                .box{
                padding: 30px 40px;
                border-radius: 5px ;
                }
                </style>

        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="bg-info box text-white">
                <div class="row">
                  <div class="col-md-9  ">

                    <div class="col-md-4 text-align">
                    <img src="img/sedih.png" style="width: 90px;">
                    </div>

                    <h5>Postif</h5>
                    <h2 id="data-kasus"> 1234 </h2>
                    <h5>Orang</h5>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="bg-danger box text-white">
                <div class="row">
                  <div class="col-md-6">

                    <div class="col-md-4">
                    <img src="img/sedih bangt.png" style="width: 90px;">
                    </div>
                    <h5>Meninggal</h5>
                    <h2 id="data-mati"> 1234 </h2>
                    <h5>Orang</h5>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="bg-success box text-white">
                <div class="row">
                  <div class="col-md-6">

                    <div class="col-md-4">
                    <img src="img/senang.png" style="width: 90px;">
                    </div>
                    <h5>Sembuh</h5>
                    <h2 id="data-sembuh"> 1234 </h2>
                    <h5>Orang</h5>
                  </div>
                
                </div>
              </div>
            </div>

             <div class="col-md-12 mt-3">
              <div class="bg-primary box text-white">
                <div class="row">
                  <div class="col-md-3">
                    <h2>INDONESIA</h2>
                    <h5 id="data-id">Positif: 12 <br>
                                     Meninggal: 20 <br>
                                     Sembuh: 5 </h5>
                   </div>
                     <div class="col-md-4">
                    <img src="img/indonesia.svg" style="width: 130px;">
                  </div>
                </div>
              </div>
            </div>

         </div>

          <div class="card mt-5">
          <div class="card-header bg-danger text-white">
            <b>Data Kasus Virus Corona di Indonesia Berdasarkan Provinsi</b>
          </div>
          <div class="card-body">
                <table class="table table-bordered">
                <thead>
                     <th>No.</th>
                     <th>Nama Provinsi</th>
                     <th>Positif</th>
                     <th>Sembuh</th>
                     <th>Meninggal</th>
                </thead>
                   <tbody id="table-data">
                     
                   </tbody>
                </table>
          </div>
        </div>
  

  </div>

  <footer class="bg-danger text-center text-white mt-3 bt-2 pb-2">
    Create by. Kementrian Kesehatan
  </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  </body>
</html>

<script>
  $(document).ready(function(){

      //panggil fungsi menampilkan semua data global
      semuaData();
      dataNegara();
      dataProvinsi();

      //untuk Merefresh sendiri 
      setInterval(function(){
         semuaData();
         dataNegara();
         dataProvinsi();
      }, 3000); 

    function semuaData(){
      $.ajax({
          url : 'https://coronavirus-19-api.herokuapp.com/all',
          success : function(data){
            try{
               var json = data;
               var kasus = data.cases;
               var meninggal = data.deaths;
               var sembuh= data.recovered;

               $('#data-kasus').html(kasus);
               $('#data-mati').html(meninggal);
               $('#data-sembuh').html(sembuh);

            }catch{
              alert('Error');
            }
          }
      });
    }

    function dataNegara(){
      $.ajax({
          url : 'https://coronavirus-19-api.herokuapp.com/countries',
          success : function(data){
            try{
               
              var json = data;
              var html = [];

              if(json.length > 0){
                  var i;
                  for(i = 0; i < json.length; i++){
                    var dataNegara = json[i];
                    var namaNegara = dataNegara.country;

                    if(namaNegara === 'Indonesia'){
                      var kasus = dataNegara.cases;
                      var mati = dataNegara.deaths;
                      var sembuh = dataNegara.recovered;
                      $('#data-id').html('Positif :'+kasus+'<br> Meninggal :'+mati+'<br> Sembuh : '+sembuh+'')

                    }

                  }
              }

            }catch{
              alert('Error');
            }
          }
      });
    }

      function dataProvinsi(){
        $.ajax({
          url : 'curl.php',
          type : 'GET',
          success : function(data){
            try{
               
               $('#table-data').html(data);

            }catch{
              alert('Error');
            }
          }
      });
      }

  });
</script>
