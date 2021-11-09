## Temat projektu: Tester (aplikacja do przeprowadzania testów)
#### Opis projektu: Aplikacja ma umożliwiać gromadzenie pytań testowych wraz z odpowiedziami, przeprowadzanie testów, wyświetlanie statystyk, rankingów.

#### Założenia:
* Aplikacja jest dostępna wyłącznie po zalogowaniu (login i hasło muszą mieć przynajmniej 6 dowolnych znaków). 
* Możliwa jest automatyczna rejestracja użytkowników po wcześniejszym sprawdzeniu czy login nie jest już zajęty. 
* Hasła przechowywane w bazie danych mają być szyfrowane. 
* Należy utworzyć konto użytkownika admin z hasłem admin.
* Każde pytanie posiada zestaw czterech odpowiedzi, z których tylko jedna jest prawidłowa.

#### Funkcje panelu administratora:
- [ ]	dodawanie, usuwanie oraz modyfikacja pytań i odpowiedzi
- [ ]	wskazanie odpowiedzi prawidłowej
- [ ]	usuwanie użytkowników
- [ ]	pokazanie statystyk (dla każdego pytania liczba poprawnych/niepoprawnych odpowiedzi, dla każdego użytkownika liczba poprawnych/niepoprawnych odpowiedzi, ranking 10 najtrudniejszych pytań, ranking 10 najlepszych użytkowników)

#### Funkcje dostępne dla pozostałych użytkowników (po zalogowaniu):
- [ ]	wylosowanie pytań (zawsze losowanych jest 10 pytań, ale nie mogą się one powtarzać w jednym losowaniu)
- [ ]	umożliwienie zaznaczenia poprawnych odpowiedzi
- [ ]	sprawdzenie liczby poprawnych/niepoprawnych odpowiedzi
- [ ]	przedstawienie wartości procentowej obliczonej jako iloraz poprawnych i wszystkich odpowiedzi
- [ ]	wyświetlenie 10 użytkowników, którzy osiągnęli najlepsze wyniki