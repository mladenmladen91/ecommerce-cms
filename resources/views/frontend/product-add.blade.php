@extends('layout', ["page_title" => 'Proizvodi-dodavanje'])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proizvodi</h1>
        </div>

    </div>
    <!-- /.container-fluid -->

    <div class="row justify-content-center">
        <div class="col-lg-12 col-12 p-4"  id="main_content">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj proizvod</h6>
                </div>
                <div class="card-body">
                   <form id="product_form">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
					  <div class="row">
					    <div class="col-3">
						  <div class="m-2">
						<label for="title">Naziv</label>
						<input class="form-control" type="text" name="name" id="name" placeholder="Naziv">
                           </div>  
						</div>
						<div class="col-3">
						  <div class="m-2">
						<label for="title">Naziv EN</label>
						<input class="form-control" type="text" name="name_en" id="name_en" placeholder="Naziv EN">
                           </div>  
						</div>
						<div class="col-3">
						  <div class="m-2">
						<label for="title">Naziv RU</label>
						<input class="form-control" type="text" name="name_ru" id="nam_ru" placeholder="Naziv RU">
                           </div>  
						</div>
						<div class="col-3">
						     <div class="m-2">
						       <label for="slug">Slug</label>
						       <input class="form-control" type="text" name="slug" id="slug" placeholder="Slug">
					         </div>
						 </div>
						  
						  <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Cijena €</label>
						<input class="form-control" type="text" name="price" id="price" placeholder="cijena">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Telekom 12 mjeseci crata €</label>
						<input class="form-control" type="text" name="telecom_12" id="telecom_12" placeholder="telekom 12">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Telekom 24 mjeseci rata €</label>
						<input class="form-control" type="text" name="telecom_24" id="telecom_24" placeholder="telekom 24">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Kartice 3 mjeseca rata €</label>
						<input class="form-control" type="text" name="card_3" id="card_3" placeholder="kartica 3">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Kartice 6 mjeseci rata €</label>
						<input class="form-control" type="text" name="card_6" id="card_6" placeholder="kartica 6">
					</div> 
						 </div>
						 
						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Kartice 12 mjeseci rata €</label>
						<input class="form-control" type="text" name="card_12" id="card_12" placeholder="kartica 12">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Kartice 24 mjeseci rata €</label>
						<input class="form-control" type="text" name="card_24" id="card_24" placeholder="kartica 24">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Kartice 48 mjeseci rata €</label>
						<input class="form-control" type="text" name="card_48" id="card_48" placeholder="kartica 48">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Smart 6 mjeseci rata €</label>
						<input class="form-control" type="text" name="smart_6" id="smart_6" placeholder="smart 6">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price"> Smart 12 mjeseci rata €</label>
						<input class="form-control" type="text" name="smart_12" id="smart_12" placeholder="smart 12">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Maloprodajna cijena €</label>
						<input class="form-control" type="text" name="retail_price" id="retail_price" placeholder="maloprodajna cijena">
					</div> 
						 </div>

						 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Količina</label>
						<input class="form-control" type="number"  name="amount" min="1" id="amount" value="1" placeholder="količina">
					</div> 
						 </div>
						  
						  <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="product_code">Šifra</label>
						<input class="form-control" type="text"  name="product_code" id="product_code" placeholder="šifra">
					</div>
						  </div>
						  
					 <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="video_link">Video link</label>
						<input class="form-control" type="text"  name="video_link" id="video_link" placeholder="video link">
					</div>
						  </div>
						  
					<div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="virtual">3d</label>
						<input class="form-control" type="text"  name="virtual" id="virtual" placeholder="3d">
					</div>
						  </div>	  
						  
					<div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="color">Boja</label>
						<input class="form-control" type="text"  name="color" id="color" placeholder="Boja">
					</div> 		  
							  
						 </div>
						  
						  
						  
							  
					<div class="col-3">		  
				<div class="inputWrapper  m-2 ">
						<label for="unit">Jedinica</label>
						 <select name="unit" class="form-control" id="unit">
							 <option value="0" selected>Komad</option>
							 <option value="1">Kg</option>
			             </select>
					</div> 
					  
					   </div>
						  
					<div class="col-3">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Kategorija</label>
						 <select  name="category_id" class="form-control" data-category-select id="category_id">
			             </select>
					</div> 
					  
					   </div>	  
						  
					<div class="col-3">
						<div class="inputWrapper  m-2 ">
						<label for="discount_id">Popust</label>
						<select class="form-control" name="discount_id" id="discount_id">
						   <option value="0">Bez popusta</option>	
						 @foreach($discounts as $discount)	
						   <option value="{{$discount->id}}">{{$discount->name}}</option>
						 @endforeach	
						</select>
					</div>
				
					   </div>
						  
						<div class="col-3">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura</label>
						 <input type="file" name="broschure" id="broschure" />
					</div> 
					  
					   </div>

					   <div class="col-3">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura EN</label>
						 <input type="file" name="broschure_en" id="broschure_en" />
					</div> 
					  
					   </div>

					   <div class="col-3">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura RU</label>
						 <input type="file" name="broschure_ru" id="broschure_ru" />
					</div> 
					  
					   </div>  
						  
						  
					   </div>
					 
					<div class="inputWrapper  m-2 ">
						 <label for="special_offer">Specijalna ponuda</label>
						 <input type="checkbox" name="special_offer" value="1" id="special_offer">
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="new">Najnoviji proizvod</label>
						 <input type="checkbox" name="new" value="1" id="new">
					</div>    
					  
						
					<div class="inputWrapper  m-2 ">
						 <label for="description">Opis</label>
						<textarea class="form-control" name="description" id="description" placeholder="opis"></textarea>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="description">Opis EN</label>
						<textarea class="form-control" name="description_en" id="description_en" placeholder="opis en"></textarea>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="description">Opis RU</label>
						<textarea class="form-control" name="description_ru" id="description_ru" placeholder="opis ru"></textarea>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="content">Specifikacije</label>
						<div class="editor" style="height:300px"></div>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="content">Specifikacije EN</label>
						<div class="editor_en" style="height:300px"></div>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="content">Specifikacije RU</label>
						<div class="editor_ru" style="height:300px"></div>
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="specification_title">Karakteristike - naslov</label>
						 <input class="form-control" type="text"  name="specification_title" id="specification_title" placeholder="Naslov karakteristika">
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="specification_title">Karakteristike - naslov EN</label>
						 <input class="form-control" type="text"  name="specification_title_en" id="specification_title_en">
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="specification_title">Karakteristike - naslov RU</label>
						 <input class="form-control" type="text"  name="specification_title_ru" id="specification_title_ru" >
					</div>

					<div class="inputWrapper  m-2 ">
						 <label for="specification_background">Karakteristike - fotografija</label>
						 <input class="form-control" type="file"  name="specification_background" id="specification_background" placeholder="Naslov fotografija">
					</div>
					
					<div class="col-12 p-0">
					<div class="m-2"><label >Karakteristike <span id="add_size" style="color:blue;cursor:pointer">Dodaj+</span></label></div>
					<div class="sizes_holder">  
					<!--<div class="inputWrapper m-2 size_container">
						<input  type="text" class="form-control size_name mb-2" placeholder="veličina">
						<input type="number" min="0" class="form-control size_amount"  placeholder="količina">
					</div> -->
				    </div> 		
					   </div>
					
					<div class="inputWrapper  m-2 ">   
					  <button class="btn btn-success" type="button" data-save-page>Sačuvaj</button>
					 </div>		
                    </form>
                </div>
            </div>
        </div>

		<div class="col-12" id="images" style="display:none">
		   <div class="col-12 m-4 p-4">
            
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addImageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj fotografije za proizvod</a>
        </div>
		</div>
    </div>

    

    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dodaj novu fotografiju</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="image-form" action="" method="post" name="addImagesToPAges" enctype="multipart/form-data">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="image-file">Fajl</label>
						<input id="image-id" type="hidden" name="product_id" value="">
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
  const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
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

// function for listing categories tree 
function children(item, selectDOM){
	let optionDOM = document.createElement("option");
	optionDOM.value = item.id;
	//optionDOM.appendChild(document.createTextNode(item.name));
	let plus = "";
	if(item.children.length > 0){
		plus = " +";
	}
	if(item.parent_id > 0){
		optionDOM.appendChild(document.createTextNode("-"+item.name+plus));
	}else{
		optionDOM.appendChild(document.createTextNode(item.name+plus));
	}
	selectDOM.appendChild(optionDOM);
	if(item.children.length > 0){
		item.children.forEach((item)=>{
			        children(item, selectDOM);
				});
	}
}	
			
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

// slugifying titles		
$('#name').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});
			
//removing sizes
$(".size_container span").click(function(){
	$(this).closest(".size_container").remove();
});			
		
// adding sizes
$("#add_size").click(function(){
	$(".sizes_holder").append('<div class="inputWrapper size_container spec_container" style="margin-bottom: 30px!important"><input required  type="text" name="label[]" class="form-control spec_title mb-2" placeholder="Naslov"><input required type="text" name="value[]"  class="form-control spec_value"  placeholder="opis"><input required  type="text" name="label_en[]" class="form-control spec_title mb-2 mt-2" placeholder="Naslov EN"><input required type="text" name="value_en[]"  class="form-control spec_value"  placeholder="opis EN"><input required  type="text" name="label_ru[]" class="form-control spec_title mb-2 mt-2" placeholder="Naslov RU"><input required type="text" name="value_ru[]"  class="form-control spec_value"  placeholder="opis RU"><input required type="file" name="specImages[]"  class="form-control spec_image" ></div>');
});	
			
			
			// getting category list
			window.Flex.Component.Product.Store.Query.listCategory().then((r)=>{
				
				let categorySelectorDOM = document.querySelector('[data-category-select]');
				r.data.categories.forEach((item)=>{
					children(item, categorySelectorDOM);
				});
				
				categorySelectorDOM.options[0].setAttribute('selected', true);
		        selectCat = categorySelectorDOM.options[0].value;
				
			})
			
            
            
		     
			
			
			

            document.querySelector('[data-save-page]').addEventListener('click', () => {
                let name = document.querySelector('#name').value;
				let content = quill.root.innerHTML;
				let content_en = quill_en.root.innerHTML;
				let content_ru = quill_ru.root.innerHTML;
               

				if(name === ""){
					alert('Popunite potrebne podatke!');
				}else{
                    

					$("#product_form").append('<input type="hidden" name="specification" value="'+content+'" /><input type="hidden" name="specification_en" value="'+content_en+'" /><input type="hidden" name="specification_ru" value="'+content_ru+'" />');
			
					console.log($("#product_form")[0]);
					window.Flex.Component.Product.Store.Command.add($("#product_form")[0]) .then((response) => {
        return response.json();
      }).then((r) => {
				   console.log(r);
					document.querySelector("#main_content").style.display = "none";
					document.querySelector("#images").style.display = "block";
					document.querySelector('[name="product_id"]').value = r.product.id;	
                }).catch((r) => {
                    console.log(r);
                });

              }
            });
			
			//adding image
			document.querySelector('[data-save-image]').addEventListener('click', () => {
                window.Flex.Component.Product.Store.Command.addImage($("#image-form")[0]).then((r) => {
					window.location="/admin/product";
				}).catch((r) => {
                    let errorDom = document.querySelector('#addImageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom čuvanja fotografije'));
                });
            });
         
        })
    </script>
@endsection