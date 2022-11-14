<?php
// Marc Peral
// script que s'encarrega de mostrar la versio actual del lloc web


// funcio que llegeix el nom del fitxer de l'ultim commit
function getCurrentGitCommit(string $branch = 'master'): string
{
    if ($hash = file_get_contents(sprintf('.git/refs/heads/%s', $branch))) {
        return $hash;
    } else {
        return "";
    }
}

// funcio que mostra una versio curta del hash del ultim commit a git
function printGitInfo(string $commit): void
{
    $version = mb_substr($commit, 0, 5);

    echo "<footer class=\"fixed-bottom\">";
    echo "<span class=\"text-muted py-1 px-1\"><a class=\"text-decoration-none \" href= \"https://github.com/mperalsapa/servidor-pt04/\">v-$version</a></span>";
    echo "</footer>";
}
