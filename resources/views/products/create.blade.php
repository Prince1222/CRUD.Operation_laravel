<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel 11 CRUD </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   
    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Simple Laravel CRUD</h1>
    </div>
   <div class="container">
    <div class="row justiy-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
        </div>
     </div>
    <div class="row d-flex  justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-1g my-4">
                <div class="card-header bg-dark">
                   <h3 class="text-white">Create Product</h3>
                </div>

                <form enctype="multipart/form-data" action="{{route('products.store')}}" method="POST">
                    @csrf
                <div class="card-body">

                    <div class="mb-3">
                        <label  for="" class="form-label h5">Name</label>
                        <input value="{{old('name')}}" type="text" class="@error('name') is-invalid @enderror form-control form-control-1g" placeholder="Name" name="name" >
                         @error('name')
                         <p class="invalid-feedback">{{ $message }}</p>
                             
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class=" form-label h5">Sku</label>
                        <input value="{{old('sku')}}" type="text" class=" @error ('sku') is-invalid @enderror  form-control form-control-1g" placeholder="sku" name="sku" >
                        @error('sku')
                         <p class="invalid-feedback">{{ $message }}</p>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="  form-label h5">Price</label>
                        <input value="{{old('price')}}" type="text" class=" @error ('price') is-invalid @enderror form-control form-control-1g" placeholder="Price" name="price" >
                        @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                        
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Description</label>
                        <textarea placeholder="description" class="form-control" name="description" cols="30" rows="5">{{old('description')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Image</label>
                        <input type="file" class="form-control form-control-1g" placeholder="Price"
                         name="image" >
                    </div>
                    <div class="d-grade">
                        <button class="btn btn-lg btn-dark">Submit</button>

                    </div>

                </div>
            </form>
            
            </div>
        </div>

    </div>
   </div>
  </body>
</html>