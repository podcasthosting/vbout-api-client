Disclaimer: This is an unofficial package for the Vbout API. This is in no way affiliated with VBOUT, Inc.

    use podcasthosting\VboutApiClient\Vbout;
    $vbout = new Vbout();

## Lists
    
    $allLists = $vbout->lists()->getLists();
    $oneList = $vbout->lists()->get(1234);
