<div>
@include('livewire.update-user-modal')
@include('livewire.create-user-form')
@include('livewire.delete-user-modal')

<div class="title-bar">
    <h4 style="float:left">Employés</h4>
    <button style="float:right"  data-bs-toggle="modal" data-bs-target="#modalCreateUser" class="btn btn-primary btn-add-user" ><i class="fa-solid fa-plus"></i></button>
 
</div>
 <div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive"> 
                <table class="table mb-0">
                   
                    <thead>
                        <tr>
                            <th>Marticule</th>
                            <th>Fonction</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->matricule}}</td>
                            <td>{{$user->fonction}}</td>
                            <td>{{$user->prenom}}</td>
                            <td>{{$user->nom}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->num_telephone}}</td>
                            <td>
                                <a href="{{ url('/users', [$user->matricule]) }}" class="btn btn-yellow"><i class="fa-solid fa-eye"></i></a>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditUser"  wire:click="editUser({{$user->id}})" ><i class="fa-solid fa-pencil"></i></button>
                                <button class="btn btn-danger btn-delete-user" data-bs-toggle="modal" data-bs-target="#modalDeleteUser" wire:click="fetchUser({{$user->id}})"><i class="fa-solid fa-trash-can"></i></button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        </div>

    </div>
</div> 



</div>