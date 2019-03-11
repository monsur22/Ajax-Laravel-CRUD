<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="ajax/ajax.js"></script>
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="well">
              <h1>Ajax Laravel Crud</h1>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-lg" id="addnew" data-toggle="modal" data-target="#modelId">
                Add
              </button>
              
              <!-- Modal -->
              <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                              <div class="modal-header">
                                      <h5 class="modal-title" id="title">Add new</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                  </div>
                          <div class="modal-body">
                              <div class="container-fluid">
                                    <input type="hidden" id="id" >
                                  <input  class="form-control" id="additem" type="text">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete" style="display:none">Delete</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" style="display:none" id="savechange">Save Change</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" id="addbutton">Add</button>
                          </div>
                      </div>
                  </div>
              </div>
              
              
                <table class="table" id="data_refresh">
                    <thead>
                        <tr>
                         
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $name)
                            
                        <tr>
                  
                            <td class="ouritem" >{{$name->id}}</td>
                            <td class="ouritem" data-toggle="modal" data-target="#modelId">{{$name->name}}
                                <input type="hidden" id="itemid" value="{{$name->id}}">
                            </td>
                            
                            <td><button class="btn-success ouritem">Edit</button>|<button class="btn-danger">Delete</button></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>

</div>
      </div>
      {{ csrf_field() }}
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function () {
        $(document).on('click','.ouritem', function (event) {

           
                var text=$(this).text();
                var id=$(this).find('#itemid').val();

                $('#title').text('Edit Item');
                var text=$.trim(text);
                $('#delete').show('400');
                $('#savechange').show('400');
                $('#addbutton').hide('400');
                $('#additem').val(text);
                $('#id').val(id);
                console.log(text);

           
            

        });
        $(document).on('click','#addnew', function (event) {
            
       
                $('#title').text('Add New');
                $('#delete').hide('400');
                $('#savechange').hide('400');
                $('#addbutton').show('400');
                $('#additem').val("");
               // console.log(text);

            

        });
        $('#addbutton').click(function(event){
                var text=$('#additem').val();
               $.post('add', {"text":text,'_token':$('input[name=_token]').val()},
                   function (data) {
                console.log(data);
                $('#data_refresh').load(location.href +' #data_refresh');
                       
                   }
                  
               );

            

        });
        $('#delete').click(function(event){
                var id=$("#id").val();
                $.post('delete', {"id":id,'_token':$('input[name=_token]').val()},
                   function (data) {
                console.log(data);
                $('#data_refresh').load(location.href +' #data_refresh');
                       
                   }
                  
               );
              // console.log(id);

        });
        $('#savechange').click(function(event){
                var id=$("#id").val();
                var value=$("#additem").val();
                $.post('update', {"id":id,"value":value,'_token':$('input[name=_token]').val()},
                   function (data) {
                console.log(data);
                $('#data_refresh').load(location.href +' #data_refresh');
                       
                   }
                  
               );
              // console.log(id);

        });
        

        
    });
    </script>
</body>
</html>