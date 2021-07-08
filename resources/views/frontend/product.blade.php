@extends('layout', ["page_title" => 'Proizvodi'])

@section('content')


<!-- modal for product sorting -->
<div id="sortModal" style="position:fixed;z-index:100;top:0;left:0;height:100%;width:100%;background:rgba(0,0,0,.5);display:none">
	<div style="background:white; border-radius:10px;position:absolute;top:50%; left:50%;width:50%; transform: translate(-50%,-50%); height:700px">
		<div class="col-12 text-center p-4" style="border-bottom: 1px solid gray">
			<select id="category_sort" class="form-control" style="width: 30%;margin:auto; display:block">
				<option selected disabled>Odaberite kategoriju</option>
				@foreach($categories as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<div id="sort_holder" class="col-12 p-4" style="height: 600px; overflow-y:scroll">

		</div>
		<div class="col-12 p-4 text-center" style="position:absolute; bottom:0 left:0;width:100%; overflow:hidden; background:white"><a href="{{route('admin.product')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Završi sortiranje</a></div>
	</div>
</div>

<!-- modal for sorting new products -->
<div id="sortNewModal" style="position:fixed;z-index:100;top:0;left:0;height:100%;width:100%;background:rgba(0,0,0,.5);display:none">
	<div style="background:white; border-radius:10px;position:absolute;top:50%; left:50%;width:50%; transform: translate(-50%,-50%); height:700px">
		
		<div id="sort_new_holder" class="col-12 p-4" style="height: 600px; overflow-y:scroll">
             @foreach($newProducts as $product)
               <div class="tester_new mb-4" data-id="{{$product->id}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15" class="fill mr-10"><path d="m464.883 64.267h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 208.867h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 353.467h-417.766c-25.98 0-47.117 21.137-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.012-21.137-47.149-47.117-47.149z"></path></svg> {{$product->name}}</div>
			 @endforeach
		</div>
		<div class="col-12 p-4 text-center" style="position:absolute; bottom:0 left:0;width:100%; overflow:hidden; background:white"><a href="{{route('admin.product')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Završi sortiranje</a></div>
	</div>
</div>

<div class="row" style="height: 97.5%;">
	<div class="col-lg-12 p-4" style="height: 100%;">
		<div class="card shadow mb-4" style="height: 100%;">
			<div class="card-header py-2 px-4">
				<div class="row">
					<div class="col-2"><select class="form-control" data-category-select>
						</select></div>
					<div class="col-2"><input id="product_search" class="form-control float-right" type="text" placeholder="Pretraži proizvod"></div>
					<div class="col-4"><button onClick="activateModal()" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">Sortiraj proizvode</button><button onClick="activateNewModal()" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm  ml-4">Sortiraj nove proizvode</button><a href="{{route('admin.product.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-4"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj proizvod</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="main_table" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Fotografija</th>
								<th>Naziv</th>
								<th>Šifra</th>
								<th>Specijalna ponuda</th>
								<th>Akcije</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
				<ul class="pagination">
					<li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
					<li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link" id="page_number">1</a></li>
					<li class="paginate_button page-item next disabled" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
				</ul>
			</div>

		</div>
	</div>

</div>


@endsection

@section('scripts')

<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
	const activateModal = () => {
		$("#sortModal").css({
			"display": "block"
		})
	}

	const activateNewModal = () => {
		$("#sortNewModal").css({
			"display": "block"
		})
	}

	document.addEventListener('DOMContentLoaded', () => {

		let table = $('#main_table').DataTable({
			"bInfo": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"oLanguage": {
				"sZeroRecords": "",
				"sEmptyTable": ""
			}
		});

		// sorting products			
		function updateToDatabase(idArray) {
			let products = [];
			for (let i = 0; i < idArray.length; i++) {
				let product = {
					"id": idArray[i]
				};
				products.push(product);
			}

			window.Flex.Component.Product.Store.Command.sortProducts(products).then((r) => {

			}).catch((r) => {
				alert('error');
			});
		}
		var target = $("#sort_holder");
		target.sortable({
			items: "div.tester",
			update: function(e, ui) {
				var sortData = target.sortable('toArray', {
					attribute: 'data-id'
				})
				
				updateToDatabase(sortData)
			}


		});


		// sorting new products			
		function updateToNewDatabase(idArray) {
			let productsNew = [];
			for (let i = 0; i < idArray.length; i++) {
				let product = {
					"id": idArray[i]
				};
				productsNew.push(product);
			}

			

			window.Flex.Component.Product.Store.Command.sortNewProducts(productsNew).then((r) => {

			}).catch((r) => {
				alert('error');
			}); 
		}

		var target_new = $("#sort_new_holder");
		target_new.sortable({
			items: "div.tester_new",
			update: function(e, ui) {
				var sortDataNew = target_new.sortable('toArray', {
					attribute: 'data-id'
				})
				console.log(sortDataNew);
				updateToNewDatabase(sortDataNew);
			}


		});


		// function for listing categories tree 
		function children(item, selectDOM) {
			let optionDOM = document.createElement("option");
			optionDOM.value = item.id;
			//optionDOM.appendChild(document.createTextNode(item.name));
			let plus = "";
			if (item.children.length > 0) {
				plus = " +";
			}
			if (item.parent_id > 0) {
				optionDOM.appendChild(document.createTextNode("-" + item.name + plus));
			} else {
				optionDOM.appendChild(document.createTextNode(item.name + plus));
			}
			selectDOM.appendChild(optionDOM);
			if (item.children.length > 0) {
				item.children.forEach((item) => {
					children(item, selectDOM);
				});
			}
		}




		function addTableRow(table, item) {
			console.log(item);
			let checked = "false";
			let offer = 0;
			if (item.special_offer === 1) {
				checked = "checked";
				value = 1;
			}
			let rowNode = table.row.add([
				`<img style="height: 60px;width:auto" src="/` + item.cover + `" />`,
				item.name,
				item.product_code,
				`<input data-action="checkbox" data-id="${item.id}" name="special_offer" type="checkbox" ${checked} class="special_offer" >`,
				`
                            <button class="btn btn-info" data-action="update" data-id="${item.id}" onClick="window.location='/admin/product/edit/` + item.id + `'" >Izmijeni</button>
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
                    `
			]).draw(false).node();
			/*let tableBody = document.querySelector("#main_table tbody");

			tableBody.innerHTML += `<tr data-tr="${item.id}"><td><img style="height: 60px;width:auto" src="/` + item.cover + `" /></td><td>${item.name}</td><td>${item.product_code}</td><td><input data-action="checkbox" data-id="${item.id}" name="special_offer" type="checkbox" ${checked} class="special_offer" ></td><td><button class="btn btn-info" data-action="update" data-id="${item.id}" onClick="window.location='/admin/product/edit/` + item.id + `'" >Izmijeni</button>
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button></td></tr>`; */


			// changing special offer state
			document.querySelector(`[data-action="checkbox"][data-id="${item.id}"]`).addEventListener('change', function() {
				let special_offer = 0;
				let id = item.id;
				if (this.checked) {
					special_offer = 1;
				}
				window.Flex.Component.Product.Store.Command.toggleSpecialOffer({
					id: id,
					offer: special_offer,
				}).then((r) => {}).catch((r) => {
					alert("Greška");
				});
			});
			document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
				window.Flex.Util.confirmModal({
					title: `Obrisi stranicu ${item.title}?`,
					content: "Da li ste sigurni da zelite da obrisete stranicu?",
					data: item,
					success: (data) => {
						window.Flex.Component.Product.Store.Command.remove(item.id).then(() => {
							table.row(rowNode).remove().draw();
						});
					}
				});
			});

		}

		let selectCat = 0;

		window.Flex.Component.Product.Store.Query.listCategory().then((r) => {
			let tableBody = document.querySelector("#main_table tbody");
			let categorySelectorDOM = document.querySelector('[data-category-select]');
			r.data.categories.forEach((item) => {
				children(item, categorySelectorDOM);
			});


			categorySelectorDOM.options[0].setAttribute('selected', true);
			selectCat = categorySelectorDOM.options[0].value;

			categorySelectorDOM.addEventListener('change', (item) => {
				let selectedValue = categorySelectorDOM.value;
				table.clear().draw();
				// getting products from category
				window.Flex.Component.Product.Store.Query.list(selectedValue, 0, 30).then((r) => {

					r.data.products.forEach((item) => {

						addTableRow(table, item);
					})

				})
			});
			//selecting first data
			window.Flex.Component.Product.Store.Query.list(selectCat, 0, 30).then((r) => {
				r.data.products.forEach((item) => {
					addTableRow(table, item);
				})

			})
		})


		//paginate table
		document.querySelector('#dataTable_previous').addEventListener("click", () => {
			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);
			if (current_value - 1 > 0) {
				let selectCat = document.querySelector('[data-category-select]').value;
				window.Flex.Component.Product.Store.Query.list(selectCat, current_value - 2, 30).then((r) => {
					table.clear().draw();
					r.data.products.forEach((item) => {
						addTableRow(table, item);
					})

					document.querySelector('#page_number').innerText = current_value - 1;

				})

			}
		});

		document.querySelector('#dataTable_next').addEventListener("click", () => {
			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);
			let selectCat = document.querySelector('[data-category-select]').value;
			window.Flex.Component.Product.Store.Query.list(selectCat, current_value, 30).then((r) => {
				table.clear().draw();
				r.data.products.forEach((item) => {
					addTableRow(table, item);
				})

				document.querySelector('#page_number').innerText = current_value + 1;

			})

		});
		// event on typing in search form for products
		$('#product_search').on('input', function() {
			let search_param = $(this).val();
			if (search_param === " " || search_param === "") {
				window.Flex.Component.Product.Store.Query.list(selectCat, 0, 30).then((r) => {
					table.clear().draw();
					r.data.products.forEach((item) => {
						addTableRow(table, item);
					})

				})
			} else {

				window.Flex.Component.Product.Store.Command.searchProducts(search_param).then((r) => {
					table.clear().draw();

					r.data.data.products.forEach((item) => {
						addTableRow(table, item);
					})

				})
			}

		});

		// getting products depending on category id 
		$("#category_sort").change(function() {
			let categoryId = $(this).val();

			window.Flex.Component.Product.Store.Command.getProductsForSorting(categoryId).then((r) => {
				let divSelectorDOM = document.querySelector('#sort_holder');
				divSelectorDOM.innerHTML = "";
				r.data.data.products.forEach((item) => {
					let divDOM = document.createElement("div");
					divDOM.className += "tester mb-4";
					divDOM.setAttribute("data-id", item.id);
					divDOM.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15" class="fill mr-10"><path d="m464.883 64.267h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 208.867h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 353.467h-417.766c-25.98 0-47.117 21.137-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.012-21.137-47.149-47.117-47.149z"></path></svg>' + " " + item.name;
					divSelectorDOM.appendChild(divDOM);
				})

			})

		});



	})
</script>
@endsection