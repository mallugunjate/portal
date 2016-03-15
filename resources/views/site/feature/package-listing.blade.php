<div class="feature_package" id="feature-package-{{$package->id}}" data-packageId = {{$package->id}}>
    <div class="package-name" data-package-open=false><h4><i class="fa fa-folder"></i> {{$package->package_screen_name}} </h4></div>
    <?php  $package_folder_listing = $package['details']['package_folders']; ?>
    <?php  $package_folder_tree = $package['details']['package_folder_tree']; ?>
    <div class="package-folder-listing hidden" data-packageid= {{$package->id}}>
        
        @foreach ($package_folder_listing as $folder)
            <div class="package_folders" id="package-folder-{{$folder->global_folder_id}}" data-packageFolderId={{$folder->global_folder_id}}>
                <?php $folderstructure = ($package['details']['package_folder_tree'][$folder->global_folder_id]); ?>
                <?php $folder_root = ($package['details']['package_folder_tree'][$folder->global_folder_id][$folder->global_folder_id]); ?>
                <ul class="tree">
                @include('site.feature.folder-structure-partial', ['folderstructure' => $folderstructure, 'folder' =>$folder_root])
                </ul>
            </div>
            
        @endforeach
    </div>
</div>