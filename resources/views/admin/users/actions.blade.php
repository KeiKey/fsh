                            <div>
                                @if ($role == \App\Enums\RoleEnum::USER)
                                    <form class="d-inline"
                                          action="{{ route('admin.users.promote', ['user' =>$id]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Do you want to make this user an administrator');">
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-success"><i
                                                class="fas fa-user-check"></i></button>
                                    </form>

                                @endif

                                @if(auth()->id() != $id)
                                        @if($role == \App\Enums\RoleEnum::ADMINISTRATOR)
                                            <form class="d-inline"
                                                  action="{{ route('admin.users.demote', ['user' => $id]) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Do you want to make this user a normal user?');">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-info"><i
                                                        class="fas fa-user-slash"></i></button>
                                            </form>
                                        @endif
                                        <form class="d-inline"
                                        action="{{ route('admin.users.delete', ['user' => $id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger"><i
                                            class="fas fa-user-times"></i></button>
                                    </form>

                                @endif

                            </div>
