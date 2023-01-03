{{-- MOD CONSTANTS --}}

<div class="drop-down-list sub-list">
    <h3 class="title">Константи:</h3>

   <div class="drop-down-list-content hide">
       <span class="file-name">Примітка</span>
       : Якщо ми додаємо якийсь ФАЙЛ до даної моделі, то вона повинна мати
       певний внутрішній ТИП файлу, по якому ми можемо визначити що це за файл,
       яку роль він виконує.
       <ul>
           <li>
               <span class="variable-name">IMAGE_ -константи</span><br>
               Всі константи, які починаються на IMAGE_ -- це типи зображень
               для даної моделі, тобто, наприклад,
               <b>IMAGE_TYPE_MAIN</b> -- це
               ТИП головного зображення
           </li>

           <li>
               <span class="variable-name">VIDEO_ -константи</span><br>
               Якщо ми додаємо якесь відео файл (не посилання, а саме файл)
               до даної модифікації, то він повинен мати тип, який починається
               на префікс <b>VIDEO_</b>
           </li>

           <li>
               <span class="variable-name">DOWNLOAD_ -константи</span><br>
               DOWNLOAD_SOURCES_TRANS -- масив ключів з перекладами для
               конкретного джерела завантаження моду.
               DOWNLOAD_SOURCES -- масив доступних, можливих джерел
               для завантаження модифікації.
           </li>

           <li>
               <span class="variable-name">SOCIAL_LINK_TYPES-константа</span><br>
               масив можливих соціальних мереж розробників модифікації.
           </li>

           <li>
               <span class="variable-name">GAME -константа</span><br>
               масив можливих базових версіх модифікації.
           </li>
       </ul>
   </div>
</div>