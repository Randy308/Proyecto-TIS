<div class="container-xl px-4 mt-4">

    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Foto de Perfil</div>
                <div class="card-body text-center" id="cardImagen">
                    <!-- Profile picture image-->
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="{{ asset($user->foto_perfil) }}" id="image-preview"
                            style="height: 300px;margin: 0 auto;" alt="" title="">
                    </div>
                    <!-- Profile picture upload button-->

                </div>
            </div>

        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Datos Personales</div>
                <div class="card-body" id="cardDatos">
                    <form action='{{ route('editUser.update' , $user->id) }}' method="POST" class="px-md-2"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p class="text-center h5">Editar Usuario</p>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="formName">Nombre completo<span
                                class="text-danger font-weight-bold "> *</span></label>
                            <input type="text" id="formName" class="form-control" name="nombre"
                                class="@error('nombre') is-invalid @enderror" value="{{ old('nombre', $user->name) }}" />
                            @error('nombre')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">

                                <div class="form-outline datepicker">
                                    <label for="formBirthDate" class="form-label">Fecha de
                                        nacimiento<span
                                        class="text-danger font-weight-bold "> *</span></label>
                                    <input type="date" class="form-control" id="formBirthDate" name="fecha_nac"
                                        class="@error('fecha_nac') is-invalid @enderror"  value="{{ old('fecha_nac', $user->fecha_nac) }}" />

                                    @error('fecha_nac')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="formFile" class="form-label">Foto de perfil</label>
                                <input class="form-control form-control-sm" name="foto_perfil" type="file" id="formFile"
                                    ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB"
                                    class="@error('foto_perfil') is-invalid @enderror">
                                @error('foto_perfil')
                                    <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                @enderror


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">

                                    <label for="formEmail" class="form-label">Correo electronico<span
                                        class="text-danger font-weight-bold "> *</span></label>
                                    <input type="email" id="formEmail" class="form-control" name="email"
                                        class="@error('email') is-invalid @enderror"  value="{{ old('email', $user->email)}}" />
                                    @error('email')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">

                                <label class="form-label" for="formInstitucion">Seleccione su Pais de origen</label><br>
                                <select class="form-control form-control" class="form-select" name="pais"
                                    id="formInstitucion">
                                    <option value="1" disabled>Pais</option>
                                    <option value="Bolivia" {{$user->pais == 'Bolivia' ? 'selected': ''}}>Bolivia</option>
                                    <option value="Argentina" {{$user->pais == 'Argentina' ? 'selected': ''}}>Argentina</option>
                                    <option value="Chile" {{$user->pais == 'Chile' ? 'selected': ''}}>Chile</option>
                                    <option value="Peru" {{$user->pais == 'Peru' ? 'selected': ''}}>Peru</option>
                                    <option value="Uruguay" {{$user->pais == 'Uruguay' ? 'selected': ''}}>Uruguay</option>
                                    <option value="Ecuador" {{$user->pais == 'Ecuador' ? 'selected': ''}}>Ecuador</option>
                                    <option value="Colombia" {{$user->pais == 'Colombia' ? 'selected': ''}}>Colombia</option>
                                    <option value="Paraguay" {{$user->pais == 'Paraguay' ? 'selected': ''}}>Paraguay</option>
                                    <option value="Brasil" {{$user->pais == 'Brasil' ? 'selected': ''}}>Brasil</option>
                                    <option value="Venezuela" {{$user->pais == 'Venezuela' ? 'selected': ''}}>Venezuela</option>
                                    <option value="Otra"  {{$user->pais == 'Otra' ? 'selected': ''}}>Otra</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">

                                <div class="form-outline datepicker">
                                    <label for="formPhoneNumber" class="form-label">Telefono<span
                                        class="text-danger font-weight-bold "> *</span></label>
                                    <input type="tel" id="formPhoneNumber" name="telefono" class="form-control"
                                        class="@error('telefono') is-invalid @enderror" value="{{ old('telefono', $user->telefono) }}" />


                                    @error('telefono')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror

                                </div>

                            </div>
                            <div class="col-md-6 mb-2">

                                <label class="form-label" for="formInstitucion">Seleccione su Institucion</label><br>
                                <select class="form-control form-control" class="form-select" name="institucion"
                                    id="formInstitucion">
                                    <option value="1" disabled>Instituciones</option>
                                    @if ($instituciones)
                                        @foreach ($instituciones as $item)
                                            <option value="{{ $item->id }}" {{ $user->institucion_id == $item->id ? 'selected': ''}}>{{ $item->nombre_institucion }}</option>
                                        @endforeach
                                    @else
                                        <option value="Otros" disabled>No existen instituciones</option>


                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="formAddressLocation">Direccion de domicilio<span
                                class="text-danger font-weight-bold "> *</span></label>
                            <input type="text" id="formAddressLocation" class="form-control" name="direccion"
                                class="@error('direccion') is-invalid @enderror"  value="{{ old('direccion', $user->direccion) }}"/>
                            @error('direccion')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="textAreaHistorial">Historial Academico<span
                                class="text-danger font-weight-bold "> *</span></label>
                            <textarea id="textAreaHistorial" class="form-control" name="historial"
                                class="@error('historial') is-invalid @enderror" cols="30" rows="3" >{{ old('historial', $user->historial_academico) }}</textarea>

                            @error('historial')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div class="pt-4 d-flex justify-content-end flex-wrap">
                            <a href="{{ route('editarPerfil') }}" class="btn btn-danger m-2">Regresar</a>
                            <button type="submit" class="btn btn-primary m-2">Aplicar cambios</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
