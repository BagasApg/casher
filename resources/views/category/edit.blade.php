<div class="card">
    <div class="card-header">
        Edit Category <strong>{{$category->name}}</strong>
    </div>
    <div class="card-body">
        <form action="{{route('category.edit', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" name="name" value="{{$category->name}}" class="form-control mb-2 ep-form-control" autofocus>
            
            <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
    </div>
</div>