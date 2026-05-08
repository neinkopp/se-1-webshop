{
  description = "Laravel Entwicklungsumgebung";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    utils.url = "github:numtide/flake-utils";
  };

  outputs =
    {
      self,
      nixpkgs,
      utils,
    }:
    utils.lib.eachDefaultSystem (
      system:
      let
        pkgs = import nixpkgs { inherit system; };

        # Erstellt eine PHP-Instanz mit allen notwendigen Treibern.
        # Nix kümmert sich hierbei selbst um das Laden der .so Dateien.
        php = pkgs.php85.withExtensions (
          { enabled, all }:
          enabled
          ++ [
            all.pdo_pgsql
            all.pgsql
            all.bcmath
            all.gd
            all.intl
            all.zip
            all.tokenizer
            all.dom
            all.xml
            all.pcov
          ]
        );
      in
      {
        devShells.default = pkgs.mkShell {
          buildInputs = [
            php
            pkgs.php85Packages.composer
            pkgs.php85Extensions.pcov
            pkgs.nodejs_20
            pkgs.postgresql
            pkgs.docker-compose
          ];

          shellHook = ''
            echo "🐘 Laravel-Umgebung bereit."
            # Verifiziert, dass die kritischen Extensions geladen sind
            php -m | grep -E "dom|tokenizer|pdo_pgsql"
          '';
        };
      }
    );
}
