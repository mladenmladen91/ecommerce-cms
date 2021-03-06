@extends('layout', ["page_title" => 'Proizvodi-dodavanje'])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Stranice</h1>
        </div>

    </div>
    <!-- /.container-fluid -->

    <div class="row justify-content-center">
        <div class="col-lg-12 col-12 p-4" id="main_content">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj stranicu</h6>
                </div>
                <div class="card-body">
                   <form id="page_form">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
					  <div class="row">
					    <div class="col-4">
						  <div class="m-2">
						<label for="title">Naziv</label>
						<input class="form-control" type="text" name="title" id="title" placeholder="Naziv">
						<input type="hidden" id="language_id" value="1" />	  
                           </div>  
						</div>
                        <div class="col-4">
						  <div class="m-2">
						<label for="title">Naziv En</label>
						<input class="form-control" type="text" name="title_en" id="title_en" placeholder="Naziv EN">  
                           </div>  
						</div>
                        <div class="col-4">
						  <div class="m-2">
						<label for="title">Naziv Ru</label>
						<input class="form-control" type="text" name="title_ru" id="title_ru" placeholder="Naziv RU">	  
                           </div>  
						</div>
						<div class="col-4">
						     <div class="m-2">
						       <label for="slug">Slug</label>
						       <input class="form-control" type="text" name="slug" id="slug" placeholder="Slug">
					         </div>
						 </div>
						  
						
						  
					<div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Kategorija</label>
						<select class="form-control" name="category_id" id="category_id">
						 @foreach($categories as $category)	
						   <option value="{{$category->id}}">{{$category->name}}</option>
						 @endforeach	
						</select>
					</div> 
					  
					   </div>	  
						  
                       <div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Bro??ura</label>
						 <input type="file" name="broschure" id="broschure" />
					</div> 
					  
					   </div>	  
						  
						  
					   </div>
					<div class="inputWrapper  m-2 ">
						 <label for="description">Opis</label>
						<input class="form-control" name="description" type="text" id="description" placeholder="opis">
					</div>

                    <div class="inputWrapper  m-2 ">
						 <label for="description">Opis En</label>
						<input class="form-control" name="description_en" type="text" id="description_en" placeholder="opis en">
					</div>

                    <div class="inputWrapper  m-2 ">
						 <label for="description">Opis Ru</label>
						<input class="form-control" name="description_ru" type="text" id="description_ru" placeholder="opis ru">
					</div>
					
					<div class="inputWrapper  m-2 ">
						 <label for="content">Tekst</label>
						<div class="editor" style="height:300px"></div>
					</div>

                    <div class="inputWrapper  m-2 ">
						 <label for="content">Tekst En</label>
						<div class="editor_en" style="height:300px"></div>
					</div>

                    <div class="inputWrapper  m-2 ">
						 <label for="content">Tekst Ru</label>
						<div class="editor_ru" style="height:300px"></div>
					</div>
					
					<div class="inputWrapper  m-2 ">   
					  <button class="btn btn-success" type="button" data-save-page>Sa??uvaj</button>
					 </div>		
                    </form>
                </div>
            </div>
        </div>

		<div class="col-12" id="images" style="display:none">
		   <div class="col-12 m-4 p-4">
            
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addImageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj fotografije za stranicu</a>
        </div>
		</div>
    </div>

<div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dodaj fotografije(mo??ete da odaberete vi??e fotografija)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="image-form" action="" method="post" name="addImagesToPAges" enctype="multipart/form-data">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="image-file">Fotografija</label>
						<input type="hidden" name="page_id" value="">
                        <input id="image-file" type="file" name="images[]" multiple>
                    </div>
				
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                    <button class="btn btn-success" type="button" data-save-image>Sacuvaj</button>
                </div>
            </div>
        </div>
    </div>     

@endsection

@section('scripts')

    <script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
			
		
		
        document.addEventListener('DOMContentLoaded', () => {
            
           // function for slugifying titles		
	function slugify(string) {
  const a = '?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????/_,:;'
  const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
  const p = new RegExp(a.split('').join('|'), 'g')

  return string.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
    .replace(/&/g, '-and-') // Replace & with 'and'
    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
}

		
			

// slugifying titles		
$('#title').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});	
			
// setting quill editor
var quill = new Quill('.editor', {
    theme: 'snow'
  });
  
  var quill_en = new Quill('.editor_en', {
    theme: 'snow'
  });  

  var quill_ru = new Quill('.editor_ru', {
    theme: 'snow'
  });  
            
            // saving page
		     document.querySelector('[data-save-page]').addEventListener('click', () => {
                let title = document.querySelector('#title').value;
                let slug = document.querySelector('#slug').value;
				let languageId = document.querySelector('#language_id').value;
				let categoryId = document.querySelector('#category_id').value;
				let content = quill.root.innerHTML;
                let content_en = quill_en.root.innerHTML;
                let content_ru = quill_ru.root.innerHTML;
				let description = document.querySelector('#description').value;
                $("#page_form").append('<input type="hidden" name="content" value="'+content+'" /><input type="hidden" name="content_en" value="'+content_en+'" /><input type="hidden" name="content_ru" value="'+content_ru+'" />');
                window.Flex.Component.Page.Store.Command.add($("#page_form")[0]).then((r) => {
					document.querySelector("#main_content").style.display = "none";
					document.querySelector("#images").style.display = "block";
					document.querySelector('[name="page_id"]').value = r.data.data.item.page_id;
				}).catch((r) => {
                   
                });

               /* window.Flex.Component.Page.Store.Command.add({
                    title: title,
                    slug: slug,
					language_id: languageId,
					category_id: categoryId,
					content: content,
					description: description,
                }).then((r) => {
					document.querySelector("#main_content").style.display = "none";
					document.querySelector("#images").style.display = "block";
					document.querySelector('[name="page_id"]').value = r.data.data.item.page_id;
				}).catch((r) => {
                    alert("Gre??ka");
                }); */
            }); 
			
			//adding image
			document.querySelector('[data-save-image]').addEventListener('click', () => {
                window.Flex.Component.Page.Store.Command.addImage($("#image-form")[0]).then((r) => {
					window.location="/admin/page";
				}).catch((r) => {
                    let errorDom = document.querySelector('#addImageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom ??uvanja fotografije'));
                });
            });
         
        })
    </script>
@endsection