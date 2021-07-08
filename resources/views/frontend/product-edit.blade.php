@extends('layout', ["page_title" => 'Proizvod-izmjena'])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proizvodi</h1>
        </div>

    </div>
    <!-- /.container-fluid -->
<ul class="nav  nav-tabs">
    <li class="active nav-item"><a class="active nav-link" data-toggle="tab" href="#change">Sadržaj</a></li>
    <li class="nav-item" ><a class="nav-link" data-toggle="tab" href="#gallery">Galerija</a></li>		 
   </ul>
    <div class="row justify-content-center">
	<div class="tab-content col-12">	
        <div id="change" class="col-lg-12 col-12 p-4 tab-pane in active">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Izmijeni proizvod</h6>
                </div>
                <div class="card-body">
                   <form id="product_form">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                   <div class="row">
					    <div class="col-6">
						  <div class="m-2">
						<label for="title">Naziv</label>
						<input type="hidden" name="product_id" id="product_id" value="{{$id}}">	  
						<input class="form-control" type="text" name="name" id="name" placeholder="Naziv">
                           </div>  
						</div>
						<div class="col-6">
						  <div class="m-2">
						<label for="title">Naziv EN</label>
						<input class="form-control" type="text" name="name_en" id="name_en" placeholder="Naziv EN">
                           </div>  
						</div>
						<div class="col-6">
						  <div class="m-2">
						<label for="title">Naziv RU</label>
						<input class="form-control" type="text" name="name_ru" id="name_ru" placeholder="Naziv RU">
                           </div>  
						</div>
						<div class="col-6">
						     <div class="m-2">
						       <label for="slug">Slug</label>
						       <input class="form-control" type="text" name="slug" id="slug" placeholder="Slug">
					         </div>
						 </div>
						  
						  <div class="col-3">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Cijena €</label>
						<input class="form-control" type="text" id="price" name="price" placeholder="cijena">
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

						 <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Količina</label>
						<input class="form-control" type="number" min="1" name="amount" id="amount" placeholder="količina">
					</div> 
						 </div>
						  
						  <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="product_code">Šifra</label>
						<input class="form-control" type="text" name="product_code" id="product_code" placeholder="šifra">
					</div>
						  </div>
					    <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="video_link">Video link</label>
						<input class="form-control" type="text"  name="video_link" id="video_link" placeholder="video link">
					</div>
						  </div>
					   
					 <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="virtual">3D</label>
						<input class="form-control" type="text"  name="virtual" id="virtual" placeholder="3d link">
					</div>
						  </div>  
					   
					<div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="color">Boja</label>
						<input class="form-control" type="text"  name="color" id="color" placeholder="Boja">
					</div> 		  
							  
						 </div>
							  
					<div class="col-6">		  
				<div class="inputWrapper  m-2 ">
						<label for="unit">Jedinica</label>
						 <select name="unit" class="form-control" id="unit">
							 <option value="0" selected>Komad</option>
							 <option value="1">Kg</option>
			             </select>
					</div> 
					  
					   </div>
						  
					<div class="col-6">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Kategorija</label>
						 <select name="category_id" class="form-control" data-category-select id="category_id">
			             </select>
					</div> 
					  
					   </div>
					   
					   <div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura</label>
						 <input type="file" name="broschure"  id="broschure" />
					</div> 
					  
					   </div>

					   <div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura EN</label>
						 <input type="file" name="broschure_en"  id="broschure_en" />
					</div> 
					  
					   </div>

					   <div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Brošura RU</label>
						 <input type="file" name="broschure_ru"  id="broschure_ru" />
					</div> 
					  
					   </div>   
						  
					<div class="col-6">
						<div class="inputWrapper  m-2 ">
						<label for="discount_id">Popust</label>
						<select name="discount_id" class="form-control" id="discount_id">
						   <option value="0">Bez popusta</option>	
						 @foreach($discounts as $discount)	
						   <option value="{{$discount->id}}">{{$discount->name}}</option>
						 @endforeach	
						</select>
					</div>
				
					   </div>	  
					<div class="col-3">
					   <div class="inputWrapper  m-2 ">
						 <label for="special_offer">Specijalna ponuda</label>
						 <input name="special_offer" type="checkbox" id="special_offer">
					</div>
					 </div>

					 <div class="col-3">
					   <div class="inputWrapper  m-2 ">
						 <label for="new">Najnoviji proizvod</label>
						 <input name="new" type="checkbox" value="1" id="new">
					</div>
					 </div>	
					     
						  
					   </div>
					  <div class="inputWrapper  m-2 ">
						 <label for="description">Opis</label>
						<textarea name="description" class="form-control" id="description" placeholder="opis"></textarea>
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
					   <img id="specification_background_image" src="" height="70">
						 <label for="specification_background">Karakteristike - fotografija</label>
						 <input class="form-control" type="file"  name="specification_background" id="specification_background" placeholder="Naslov fotografija">
					</div>
					   
					   
					<div class="col-12">   
					<div class="mb-2"><label >Karakteristike <span id="add_size" style="color:blue;cursor:pointer">Dodaj+</span></label></div>
					<div class="sizes_holder"> 
				@foreach($specifications as $specification)	
				<div class="inputWrapper size_container spec_container">
					<input type="hidden" name="spec_id"  value="{{$specification->id}}">
					<input required  type="text" name="label"  value="{{$specification->label}}" class="form-control spec_title mb-2" placeholder="Naslov" />
					<input required type="text" name="value" value="{{$specification->value}}"  class="form-control spec_value"  placeholder="opis" />
					<input required  type="text" name="label_en"  value="{{$specification->label_en}}" class="form-control spec_title_en mb-2 mt-2" placeholder="Naslov EN" />
					<input required type="text" name="value_en" value="{{$specification->value_en}}"  class="form-control spec_value_en"  placeholder="opis en" />
					<input required  type="text" name="label_ru"  value="{{$specification->label_ru}}" class="form-control spec_title_ru mb-2 mt-2" placeholder="Naslov RU" />
					<input required type="text" name="value_ru" value="{{$specification->value_ru}}"  class="form-control spec_value_ru"  placeholder="opis ru" />
					@if($specification->image)
					<img style="margin-top: 15px; margin-bottom: 15px" src="/{{$specification->image}}" height="40" width="40" />
					@endif
					<input required type="file" name="aSpecImage"  class="form-control spec_image" />
					<a class="mt-2" data-id="{{$specification->id}}" title="Obriši" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</div>
				@endforeach		
				    </div> 		
					   </div>  
					
					<div class="inputWrapper  m-2 ">   
					  <button class="btn btn-success" type="button" data-update-page>Ažuriraj proizvod</button>
					  <a href="{{route('admin.product')}}" class="btn btn-info" style="color:white">Odustani od izmjena</a>	
					 </div>		
                    </form>
                </div>
            </div>
        </div>
		
		<div id="gallery" class="tab-pane fade" >
		     <div class="row">
		<div class="col-12 m-2 p-4">
            
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addImageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj fotografiju</a>
        </div>		 
        <div class="col-lg-12 p-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista Fotografija</h6>
                </div>
                <div class="card-body">
					<div class="row" id="row">
					 
					</div>
                </div>
            </div>
        </div>

    </div>	
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
						<input id="image-id" type="hidden" name="product_id" value="{{$id}}">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
			
		
		
        document.addEventListener('DOMContentLoaded', () => {

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
			
// sorting images		
function updateToDatabase(idArray){
	    let categories = [];
	    for(let i = 0;i < idArray.length; i++){
			let category = {
				"id": idArray[i]
			};
			categories.push(category);
		}
	    
	    window.Flex.Component.Product.Store.Command.sortImages(categories).then((r) => {
					console.log(r);
          }).catch((r) => {
                    alert('error');
           });
    	
    	}
 var target =  $("#row");   
target.sortable({
  items: "div.col-3",
  update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData);
            }
        
        
    });	
	
	

			
            
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
	
	if(item.id=={{$category_id}}){
		optionDOM.setAttribute("selected",true);
	}
	
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



			
			

// slugifying titles		
$('#name').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});
			
//removing sizes
$(".size_container span").click(function(){
	$(this).closest(".size_container").remove();
});	

$(".spec_container input").change(function(){
	let form = new FormData();
	let label = $(this).closest(".spec_container").find("input[name='label']").val();
	let value = $(this).closest(".spec_container").find("input[name='value']").val();
	let label_en = $(this).closest(".spec_container").find("input[name='label_en']").val();
	let value_en = $(this).closest(".spec_container").find("input[name='value_en']").val();
	let label_ru = $(this).closest(".spec_container").find("input[name='label_ru']").val();
	let value_ru = $(this).closest(".spec_container").find("input[name='value_ru']").val();
	let spec_id = $(this).closest(".spec_container").find("input[name='spec_id']").val();
	form.append("label", label);
	form.append("value", value);
	form.append("label_en", label_en);
	form.append("value_en", value_en);
	form.append("label_ru", label_ru);
	form.append("value_ru", value_ru);
	form.append("id", spec_id);
	if($(this).attr("name") == 'aSpecImage'){
	let image = $(this).closest(".spec_container").find("input[name='aSpecImage']")[0].files[0];
	form.append("image", image);
    }

	window.Flex.Component.Product.Store.Command.updateSpec(form).then((r) => {
				   console.log(r);
                }).catch((r) => {
                    console.log(r);
                });
});

$(".spec_container a").click(function(e){
	e.preventDefault();
	let id = $(this).attr("data-id");
	window.Flex.Component.Product.Store.Command.removeSpec(id).then((r) => {
				   $(this).closest(".spec_container").remove();
                }).catch((r) => {
                    console.log(r);
                });
})
		
// adding sizes
$("#add_size").click(function(){
	$(".sizes_holder").append('<div class="inputWrapper size_container spec_container" style="margin-bottom: 30px!important"><input required  type="text" name="label[]" class="form-control spec_title mb-2" placeholder="Naslov"><input required type="text" name="value[]"  class="form-control spec_value"  placeholder="opis"><input required  type="text" name="label_en[]" class="form-control spec_title mb-2 mt-2" placeholder="Naslov EN"><input required type="text" name="value_en[]"  class="form-control spec_value"  placeholder="opis EN"><input required  type="text" name="label_ru[]" class="form-control spec_title mb-2 mt-2" placeholder="Naslov RU"><input required type="text" name="value_ru[]"  class="form-control spec_value"  placeholder="opis RU"><input required type="file" name="specImages[]"  class="form-control spec_image" ></div>');
});	
			
			
			// listing categories
			window.Flex.Component.Product.Store.Query.listCategory().then((r)=>{
				
				let categorySelectorDOM = document.querySelector('[data-category-select]');
				r.data.categories.forEach((item)=>{
					children(item, categorySelectorDOM);
				});
				
				
				/*categorySelectorDOM.options[0].setAttribute('selected', true);
		        selectCat = categorySelectorDOM.options[0].value;*/
				
				
				
			})
			
            
            
		     
			// getting data from product_id
			window.Flex.Component.Product.Store.Query.getProduct({{$id}}).then((r)=>{
				
				 let rowDOM = document.querySelector('#row');
			   r.data.images.forEach((item) => {
               let divDOM = document.createElement("div");
	            divDOM.className += "col-3";
	            divDOM.style.position = 'relative';
				divDOM.style.marginBottom = '30px';   
				divDOM.setAttribute("data-id", item.id);   
				let imageDOM = document.createElement("img"); 
				imageDOM.setAttribute("src", "/"+item.image);
				imageDOM.setAttribute("width", "100%"); 
				imageDOM.setAttribute("height", "auto");    
				 divDOM.appendChild(imageDOM);
				 rowDOM.appendChild(divDOM); 
				   
				 let xButtonDOM = document.createElement('span');
				  xButtonDOM.style.position = 'absolute'; 
				  xButtonDOM.style.top = '20px'; 
				  xButtonDOM.style.right = '40px';  
				  xButtonDOM.style.color = 'red';
				  xButtonDOM.style.cursor = 'pointer'; 
				  xButtonDOM.style.fontSize = '20px';
				  xButtonDOM.style.fontWeight = 'bold'; 
				  xButtonDOM.style.zIndex = '100';
				  xButtonDOM.innerText = 'X'; 
				  divDOM.appendChild(xButtonDOM); 
				  // removing image on x click 
				  xButtonDOM.addEventListener('click', (i,j) => {
					    window.Flex.Component.Product.Store.Command.removeImage(item.id, item.image).then(() => {
                                xButtonDOM.closest(".col-3").remove();
                            });
                    });
                });
				
				document.querySelector('#name').value = r.data.product.name;
				document.querySelector('#name_en').value = r.data.product.name_en;
				document.querySelector('#name_ru').value = r.data.product.name_ru;
                let slug = document.querySelector('#slug').value = r.data.product.slug;
				/*$("#category_id option").each(function(){
						if($(this).val() == r.data.product.category_id){
							$(this).attr("selected","selected");
						}
				});*/
				document.querySelector('#price').value= r.data.product.price;
				document.querySelector('#telecom_12').value= r.data.product.telecom_12;
				document.querySelector('#telecom_24').value= r.data.product.telecom_24;
				document.querySelector('#card_3').value= r.data.product.card_3;
				document.querySelector('#card_6').value= r.data.product.card_6;
				document.querySelector('#card_12').value= r.data.product.card_12;
				document.querySelector('#card_24').value= r.data.product.card_24;
				document.querySelector('#card_48').value= r.data.product.card_48;
				document.querySelector('#smart_6').value= r.data.product.smart_6;
				document.querySelector('#smart_12').value= r.data.product.smart_12;
				document.querySelector('#retail_price').value= r.data.product.retail_price;
				document.querySelector('#color').value = r.data.product.color;
				document.querySelector('#product_code').value = r.data.product.product_code;
				document.querySelector('#description').value= r.data.product.description;
				document.querySelector('#description_en').value= r.data.product.description_en;
				document.querySelector('#description_ru').value= r.data.product.description_ru;
				document.querySelector('#amount').value = r.data.product.amount;
				document.querySelector('#video_link').value = r.data.product.video_link;
				document.querySelector('#virtual').value = r.data.product.virtual;
				document.querySelector('#specification_title').value = r.data.product.specification_title;
				document.querySelector('#specification_title_en').value = r.data.product.specification_title_en;
				document.querySelector('#specification_title_ru').value = r.data.product.specification_title_ru;
				document.querySelector('#specification_background_image').src = "/"+r.data.product.specification_background;
				quill.root.innerHTML = r.data.product.specification; 
				quill_en.root.innerHTML = r.data.product.specification_en;
				quill_ru.root.innerHTML = r.data.product.specification_ru;  
				document.querySelector('#unit').value;
				$("#unit option").each(function(){
						if($(this).val() == r.data.product.unit){
							$(this).attr("selected","selected");
						}
				});
				$("#discount_id option").each(function(){
						if($(this).val() == r.data.product.discount_id){
							$(this).attr("selected","selected");
						}
				});
				
				if(r.data.product.special_offer === 1){
					document.querySelector('#special_offer').checked = true;
				}

				if(r.data.product.new === 1){
					document.querySelector('#new').checked = true;
				}
				
			});
			
			

              document.querySelector('[data-update-page]').addEventListener('click', () => {
                let name = document.querySelector('#name').value;
                let slug = document.querySelector('#slug').value;
				let categoryId = document.querySelector('#category_id').value;
				let price = document.querySelector('#price').value;
				let color = document.querySelector('#color').value;
				let productCode = document.querySelector('#product_code').value;
				let description = document.querySelector('#description').value;
				let amount = document.querySelector('#amount').value; 
				let unit = document.querySelector('#unit').value;
				let discountId = document.querySelector('#discount_id').value;
				let specialOffer = (document.querySelector('#special_offer').checked == true) ? 1:0;
				let content = quill.root.innerHTML;
				let content_en = quill_en.root.innerHTML;
				let content_ru = quill_ru.root.innerHTML;



				if(name === ""){
					alert('Popunite potrebne podatke!');
				}else{
			//console.log($("#product_form")[0]);
			$("#product_form").append('<input type="hidden" name="specification" value="'+content+'" /><input type="hidden" name="specification_en" value="'+content_en+'" /><input type="hidden" name="specification_ru" value="'+content_ru+'" />');
            window.Flex.Component.Product.Store.Command.update($("#product_form")[0]).then((r) => {
				   alert("Uspješno sačuvano!");	
                }).catch((r) => {
                    alert("Greška u čuvanju!");
                });
             /*  window.Flex.Component.Product.Store.Command.update({
                    name: name,
                    slug: slug,
				    price: price,
					category_id: categoryId,
					description: description,
				    product_code: productCode,
				    color: color,
				    unit: unit,
				    discount_id: discountId,
					amount: amount,
				   // sizes: JSON.stringify(selected),
				    special_offer : specialOffer,
				    product_id: {{$id}}
                }).then((r) => {
				   alert("Uspješno sačuvano!");	
                }).catch((r) => {
                    alert("Greška u čuvanju!");
                }); */
					
				} 
            });
			
			
			//adding image
			document.querySelector('[data-save-image]').addEventListener('click', () => {
                window.Flex.Component.Product.Store.Command.addImage($("#image-form")[0]).then((r) => {
					location.reload();
				}).catch((r) => {
                    let errorDom = document.querySelector('#addImageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom čuvanja fotografije'));
                });
            });
      
        })
    </script>
@endsection