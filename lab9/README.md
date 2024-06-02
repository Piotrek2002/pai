1. **Do czego służą poszczególne warstwy architektury MVC i jak są połączone?**

   **Model-View-Controller (MVC)** to wzorzec architektoniczny używany do tworzenia aplikacji internetowych, składający się z trzech głównych komponentów:
   - **Model**: Odpowiada za logikę biznesową i dane aplikacji. Model zarządza danymi, regułami biznesowymi, logiką i funkcjami. W ASP.NET modele często interagują z bazą danych za pomocą ORM, np. Entity Framework.
   - **View (Widok)**: Odpowiada za prezentację danych. Widoki generują interfejs użytkownika aplikacji. W ASP.NET widoki są zazwyczaj plikami Razor (.cshtml) zawierającymi HTML i wbudowany kod C#.
   - **Controller (Kontroler)**: Odpowiada za obsługę żądań od użytkowników. Kontrolery przetwarzają żądania HTTP, wykonują operacje za pośrednictwem modeli i zwracają odpowiedni widok do przeglądarki użytkownika. Każdy kontroler zazwyczaj obsługuje jedną lub więcej akcji.

   **Połączenia między warstwami:**
   - Kontroler odbiera żądanie od przeglądarki, przetwarza je za pomocą modelu, a następnie zwraca odpowiedni widok.
   - Model wykonuje logikę biznesową i aktualizuje stan aplikacji.
   - Widok wyświetla dane przekazane przez kontroler, które pochodzą z modelu.

2. **Jakie są konwencje nazewnictwa dla:**
   - **Modeli**: Klasy modeli są nazwane rzeczownikami w liczbie pojedynczej (np. `User`, `Product`). Pliki modeli są przechowywane w folderze `Models`.
   - **Kontrolerów**: Klasy kontrolerów mają nazwę kończącą się na "Controller" (np. `HomeController`, `AccountController`). Pliki kontrolerów są przechowywane w folderze `Controllers`.
   - **Akcji kontrolera**: Metody akcji w kontrolerach są nazwane czasownikami lub frazami czasownikowymi (np. `Index`, `Create`, `Edit`).
   - **Widoków**: Pliki widoków mają nazwę odpowiadającą nazwie metody akcji kontrolera (np. `Index.cshtml`, `Edit.cshtml`). Widoki są przechowywane w folderach odpowiadających nazwie kontrolera, wewnątrz folderu `Views`.
   - **Folderów widoków**: Foldery widoków są nazwane zgodnie z nazwą kontrolera (bez sufiksu "Controller") (np. widoki dla `HomeController` będą przechowywane w folderze `Views/Home`).

3. **Jak dane przekazywane są z kontrolerów do widoków (podaj 2 opcje)?**
   - **ViewBag/ViewData**: Umożliwiają dynamiczne przekazywanie danych z kontrolera do widoku. `ViewBag` jest dynamicznym obiektem, natomiast `ViewData` to słownik.
     ```csharp
     ViewBag.Message = "Hello, World!";
     return View();
     ```
     ```csharp
     ViewData["Message"] = "Hello, World!";
     return View();
     ```
   - **Model**: Można przekazać dane bezpośrednio do widoku jako model. Model może być dowolnym obiektem lub klasą.
     ```csharp
     var model = new MyModel { Message = "Hello, World!" };
     return View(model);
     ```

4. **Jak mapowane są URLs na akcje kontrolerów?**

   Mapowanie URL-i na akcje kontrolerów jest realizowane za pomocą routingu. Domyślna konfiguracja routingu w ASP.NET MVC jest ustawiona w pliku `RouteConfig.cs` i wygląda następująco:
   ```csharp
   routes.MapRoute(
       name: "Default",
       url: "{controller}/{action}/{id}",
       defaults: new { controller = "Home", action = "Index", id = UrlParameter.Optional }
   );
   ```
   Ta konfiguracja oznacza, że URL `http://example.com/Products/Details/5` będzie mapowany na akcję `Details` kontrolera `Products`, z parametrem `id` o wartości `5`.

5. **Jak ograniczać akcje kontrolera tak by były uruchamiane tylko z użyciem wskazanych typów zapytań HTTP (np. ograniczenie do HTTP POST)?**

   Można używać atrybutów do określenia, które typy zapytań HTTP mogą uruchamiać akcje kontrolera:
   - **[HttpGet]**: Ogranicza akcję do żądań GET.
   - **[HttpPost]**: Ogranicza akcję do żądań POST.
   - **[HttpPut]**: Ogranicza akcję do żądań PUT.
   - **[HttpDelete]**: Ogranicza akcję do żądań DELETE.
   
   Przykład:
   ```csharp
   [HttpPost]
   public ActionResult Create(MyModel model)
   {
       // Kod akcji
   }
   ```

6. **Gdzie zdefiniowana jest walidacja danych i jak realizowana jest w widokach i kontrolerach?**

   **Walidacja danych** jest zazwyczaj definiowana w modelach za pomocą atrybutów walidacji, które są częścią `System.ComponentModel.DataAnnotations`. Przykład:
   ```csharp
   public class MyModel
   {
       [Required]
       [StringLength(100)]
       public string Name { get; set; }

       [Range(1, 100)]
       public int Age { get; set; }
   }
   ```

   **W kontrolerach** walidacja jest realizowana przez sprawdzenie `ModelState`:
   ```csharp
   [HttpPost]
   public ActionResult Create(MyModel model)
   {
       if (ModelState.IsValid)
       {
           // Kod akcji w przypadku poprawnych danych
       }
       else
       {
           // Kod akcji w przypadku niepoprawnych danych
       }
   }
   ```

   **W widokach** walidacja jest realizowana za pomocą pomocników HTML, takich jak `Html.ValidationMessageFor` i `Html.ValidationSummary`:
   ```html
   @model MyModel

   <form asp-action="Create" method="post">
       <div>
           @Html.LabelFor(m => m.Name)
           @Html.TextBoxFor(m => m.Name)
           @Html.ValidationMessageFor(m => m.Name)
       </div>
       <div>
           @Html.LabelFor(m => m.Age)
           @Html.TextBoxFor(m => m.Age)
           @Html.ValidationMessageFor(m => m.Age)
       </div>
       <button type="submit">Submit</button>
   </form>

   @Html.ValidationSummary()
   ```