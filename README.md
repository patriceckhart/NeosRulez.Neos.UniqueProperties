# Unique properties for Neos CMS.

NeosRulez.Neos.UniqueProperties allows setting unique properties in Neos CMS.

## Installation

The NeosRulez.Neos.UniqueProperties is listed on packagist (https://packagist.org/packages/neosrulez/neos-uniqueproperties) - therefore you don't have to include the package in your "repositories" entry any more.

Just run ```composer require neosrulez/neos-uniqueproperties```

## Settings.yaml

```yaml
NeosRulez:
  Neos:
    UniqueProperties:
      uriPathSegmet:
        nodeTypes:
          - 'Acme.Site:Document.HomePage'
          - 'Acme.Site:Document.Page'
```

## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com
