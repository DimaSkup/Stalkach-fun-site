<div class="drop-down-list">
    <h3 class="title">Функції для feature-тестів:</h3>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">getRawCorrectData(User $relatedUser): array</span>
                <p>
                    Повертає масив КОРЕКТНИХ даних формату ['ключ' => 'значення']
                    немов ми отримуємо їх від форми створення модифікації.
                    Використовується для тестування процесу безпомилкового
                    створення модифікації.
                </p>
            </li>

            <li>
                <span class="function-name">getRawWrongData(User $relatedUser): array</span>
                <p>
                    Повертає масив НЕКОРЕКТНИХ даних формату ['ключ' => 'значення']
                    немов ми отримуємо їх від форми створення модифікації.
                    Використовується для тестування процесу створення модифікації
                    для ситуації, коли нам приходять УСІ значення полів з неправильними
                    даними.
                </p>
            </li>
        </ul>
        <br><br><hr>
    </div>
</div>