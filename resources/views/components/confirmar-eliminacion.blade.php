<el-dialog>
  <dialog
    id="{{ $id }}"
    aria-labelledby="dialog-title"
    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

    {{-- Fondo transparente/oscuro --}}
    <el-dialog-backdrop
      class="fixed inset-0 bg-black/40 transition-opacity
            data-closed:opacity-0
            data-enter:duration-300
            data-enter:ease-out
            data-leave:duration-200
            data-leave:ease-in"></el-dialog-backdrop>


    {{-- Contenedor del modal --}}
    <div
      tabindex="0"
      class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-0">

      <el-dialog-panel
        class="
                    relative
                    transform
                    overflow-hidden
                    rounded-lg
                    bg-white
                    px-4
                    pt-5
                    pb-4
                    text-left
                    shadow-xl
                    transition-all
                    data-closed:translate-y-4
                    data-closed:opacity-0
                    data-enter:duration-300
                    data-enter:ease-out
                    data-leave:duration-200
                    data-leave:ease-in
                    sm:my-8
                    sm:w-full
                    sm:max-w-lg
                    sm:p-6
                    data-closed:sm:translate-y-0
                    data-closed:sm:scale-95
                    dark:bg-gray-800
                    dark:outline
                    dark:-outline-offset-1
                    dark:outline-white/10
                ">

        <div class="sm:flex sm:items-start">

          {{-- Icono --}}
          <div
            class="
                            mx-auto
                            flex
                            size-12
                            shrink-0
                            items-center
                            justify-center
                            rounded-full
                            bg-red-100
                            sm:mx-0
                            sm:size-10
                            dark:bg-red-500/10
                        ">

            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              aria-hidden="true"
              class="size-6 text-red-600 dark:text-red-400">
              <path
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>

          </div>


          {{-- Texto --}}
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">

            <h3
              id="dialog-title"
              class="text-2xl font-semibold text-gray-900 dark:text-white">
              {{ $title }}
            </h3>

            <div class="mt-2">

              <p class="text-lg text-gray-500 dark:text-gray-400">
                {{ $message }}
              </p>

            </div>

          </div>

        </div>


        {{-- Botones --}}
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-3">

          {{-- Eliminar --}}
          <form
            method="POST"
            action="{{ $action }}"
            class="w-full sm:w-auto">

            @csrf
            @method('DELETE')

            <button
              type="submit"
              command="close"
              commandfor="{{ $id }}"
              class="
                                inline-flex
                                w-full
                                justify-center
                                rounded-md
                                bg-red-600
                                px-3
                                py-2
                                text-sm
                                font-semibold
                                text-white
                                shadow-xs
                                hover:bg-red-500
                                sm:w-auto
                                dark:bg-red-500
                                dark:shadow-none
                                dark:hover:bg-red-400
                            ">
              Eliminar
            </button>

          </form>


          {{-- Cancelar --}}
          <button
            type="button"
            command="close"
            commandfor="{{ $id }}"
            class="
                            mt-3
                            inline-flex
                            w-full
                            justify-center
                            rounded-md
                            bg-white
                            px-3
                            py-2
                            text-sm
                            font-semibold
                            text-gray-900
                            shadow-xs
                            inset-ring-1
                            inset-ring-gray-300
                            hover:bg-gray-50
                            sm:mt-0
                            sm:w-auto
                            dark:bg-white/10
                            dark:text-white
                            dark:shadow-none
                            dark:inset-ring-white/5
                            dark:hover:bg-white/20
                        ">
            Cancelar
          </button>

        </div>

      </el-dialog-panel>

    </div>

  </dialog>
</el-dialog>