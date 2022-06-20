In this Laravel project:
1. An HTTP request is sent to the external open API to receive some data.
2. The desired data is extracted from the received response.(The Factory pattern is used to categorize responses based on Json or XML body.)
3. The extracted data is mapped to a specific database table via the YAML file mapper. (The Factory pattern is used to generate a collection of models based on Json or XML data structures.)
4. The models collection save into database.
