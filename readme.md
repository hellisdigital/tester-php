## Temat projektu: Tester (aplikacja do przeprowadzania testów)

#### Opis projektu: Aplikacja ma umożliwiać gromadzenie pytań testowych wraz z odpowiedziami, przeprowadzanie testów, wyświetlanie statystyk, rankingów.

#### Założenia:

[x] Aplikacja jest dostępna wyłącznie po zalogowaniu (login i hasło muszą mieć przynajmniej 6 dowolnych znaków).
[x] Możliwa jest automatyczna rejestracja użytkowników po wcześniejszym sprawdzeniu czy login nie jest już zajęty.
[x] Hasła przechowywane w bazie danych mają być szyfrowane.
[x]Należy utworzyć konto użytkownika admin z hasłem admin.
[x] Każde pytanie posiada zestaw czterech odpowiedzi, z których tylko jedna jest prawidłowa.

#### Funkcje panelu administratora:

- [x] dodawanie, usuwanie oraz modyfikacja pytań i odpowiedzi
- [x] wskazanie odpowiedzi prawidłowej
- [x] usuwanie użytkowników
- [x] pokazanie statystyk (dla każdego pytania liczba poprawnych/niepoprawnych odpowiedzi, dla każdego użytkownika liczba poprawnych/niepoprawnych odpowiedzi, ranking 10 najtrudniejszych pytań, ranking 10 najlepszych użytkowników)

#### Funkcje dostępne dla pozostałych użytkowników (po zalogowaniu):

- [ ] wylosowanie pytań (zawsze losowanych jest 10 pytań, ale nie mogą się one powtarzać w jednym losowaniu)
- [ ] umożliwienie zaznaczenia poprawnych odpowiedzi
- [ ] sprawdzenie liczby poprawnych/niepoprawnych odpowiedzi
- [ ] przedstawienie wartości procentowej obliczonej jako iloraz poprawnych i wszystkich odpowiedzi
- [ ] wyświetlenie 10 użytkowników, którzy osiągnęli najlepsze wyniki
