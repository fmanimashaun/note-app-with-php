FROM mysql:8.0

# Avoid warnings by switching to noninteractive
ENV DEBIAN_FRONTEND=noninteractive

# Configure apt and install packages
RUN apt-get update \
    && apt-get -y install --no-install-recommends apt-utils dialog 2>&1 \
    && apt-get -y install git iproute2 procps lsb-release \
    && apt-get install -y php php-mysql \
    && apt-get autoremove -y \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/*

# Copy the database setup script into the Docker image
COPY setup.sql /docker-entrypoint-initdb.d/

# Switch back to dialog for any ad-hoc use of apt-get
ENV DEBIAN_FRONTEND=dialog
