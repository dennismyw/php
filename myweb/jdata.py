import pymysql
import json

# Database connection details
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '123456',
    'db': 'hpidb',
    'charset': 'utf8mb4',
    'cursorclass': pymysql.cursors.DictCursor
}

# Open database connection
connection = pymysql.connect(**db_config)

try:
    with connection.cursor() as cursor:
        # Load JSON data
        with open('unipro.json') as file:
            data = json.load(file)

        # Prepare SQL queries for each table
        insert_entry = """
            INSERT INTO entries (
                entry_type, primary_accession, uniprotkb_id, first_public_date, 
                last_annotation_update_date, last_sequence_update_date, 
                entry_version, sequence_version, annotation_score, protein_existence, 
                sequence, length, mol_weight, crc64, md5
            ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """

        insert_organism = """
            INSERT INTO organisms (scientific_name, taxon_id, lineage)
            VALUES (%s, %s, %s)
        """

        insert_gene = """
            INSERT INTO genes (gene_name, orf_name)
            VALUES (%s, %s)
        """

        insert_comment = """
            INSERT INTO comments (comment_type, value)
            VALUES (%s, %s)
        """

        insert_feature = """
            INSERT INTO features (type, start, end, description)
            VALUES (%s, %s, %s, %s)
        """

        # Insert data into tables
        for result in data['results']:
            # Insert into entries table
            cursor.execute(insert_entry, (
                result['entryType'],
                result['primaryAccession'],
                result['uniProtkbId'],
                result['entryAudit']['firstPublicDate'],
                result['entryAudit']['lastAnnotationUpdateDate'],
                result['entryAudit']['lastSequenceUpdateDate'],
                result['entryAudit']['entryVersion'],
                result['entryAudit']['sequenceVersion'],
                result['annotationScore'],
                result['proteinExistence'],
                result['sequence']['value'],
                result['sequence']['length'],
                result['sequence']['molWeight'],
                result['sequence']['crc64'],
                result['sequence']['md5']
            ))

            # Insert into organisms table
            cursor.execute(insert_organism, (
                result['organism']['scientificName'],
                result['organism']['taxonId'],
                ','.join(result['organism']['lineage'])
            ))

            # Insert into genes table
            for gene in result['genes']:
                cursor.execute(insert_gene, (
                    gene['geneName']['value'],
                    gene['orfNames'][0]['value']
                ))

            # Insert into comments table
            for comment in result['comments']:
                cursor.execute(insert_comment, (
                    comment['commentType'],
                    comment['texts'][0]['value'] if 'texts' in comment else None
                ))

            # Insert into features table
            for feature in result['features']:
                cursor.execute(insert_feature, (
                    feature['type'],
                    feature['location']['start']['value'],
                    feature['location']['end']['value'],
                    feature['description']
                ))

        # Commit the transaction
        connection.commit()

finally:
    # Close the connection
    connection.close()
