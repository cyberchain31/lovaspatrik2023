<?php
    // Načítá pole z formuláře - name, email a message; odstraňuje bílé znaky; odstraňuje HTML
    $name = strip_tags(trim($_POST["name"]));
    $name= str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    // trim odstranuje medzery
    $object = trim($_POST["object"]);
    $message = trim($_POST["message"]);

    // Kontroluje data popř. přesměruje na chybovou adresu
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: https://www.lovaspatrik.sk/index.html?success=-1#form");
        exit;
    }

    // Nastavte si email, nakterý chcete, aby se vyplněný formulář odeslal - jakýkoli váš email
    $recipient = "cyberchain@lovaspatrik.sk";

    // Nastavte předmět odeslaného emailu
    $subject = "Máte nový kontakt od: $name";

    // Obsah emailu, který se vám odešle
    $email_content = "Meno: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Predmet: $object\n\n";
    $email_content .= "Správa:\n$message\n";

    // Emailová hlavička
    $email_headers = "From: $name <$email>";

    // Odeslání emailu - dáme vše dohromady
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Přesměrování na stránku, pokud vše proběhlo v pořádku
    // header("Location: https://www.lovaspatrik.sk/index.html?success=1#form");
    header("Location: https://www.lovaspatrik.sk/formthanks.html?success=1#form");
?>




