import xml.etree.ElementTree as ET
import mysql.connector


def inserir_XML(arquivo):

    mydb = mysql.connector.connect(
        host="yourhost",
        user="youruser",
        password="yourpassword",
        database="yourdatabase"
    )

    mycursor = mydb.cursor()

    tree = ET.parse(arquivo)
    root = tree.getroot()
    for x in root:
        sql = "INSERT INTO file_metadata (file_name, file_type, file_description, file_keywords, file_theme, file_publisher, file_creator, file_team, file_team_members, file_issued, file_modified, file_collection_date, file_start_date, file_end_date, file_spatial, file_source, file_language, file_url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"

        val = (
            x.find("name").text, x.find(
                "type").text, x.find("description").text,
            x.find("keywords").text, x.find(
                "theme").text, x.find("publisher").text,
            x.find("creator").text, x.find(
                "team").text, x.find("teamMembers").text,
            x.find("issued").text, x.find(
                "modified").text, x.find("collectionDate").text,
            x.find("startDate").text, x.find(
                "endDate").text, x.find("spatial").text,
            x.find("source").text, x.find("language").text, x.find("url").text
        )

        mycursor.execute(sql, val)

        mydb.commit()


arquivo = 'CAMINHO_PARA_ARQUIVO/metadados.xml'
inserir_XML(arquivo)
